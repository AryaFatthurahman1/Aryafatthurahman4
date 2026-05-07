<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->message) && !empty($data->user_id)) {
    
    // Save user message to chat history
    session_start();
    $session_id = session_id() ?: uniqid();
    
    $query = "INSERT INTO chat_history (user_id, message, session_id) VALUES (:user_id, :message, :session_id)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->bindParam(":message", $data->message);
    $stmt->bindParam(":session_id", $session_id);
    $stmt->execute();
    
    // Call Gemini API
    $response = chatWithGemini($data->message);
    
    // Save AI response to chat history
    $update_query = "UPDATE chat_history SET response = :response WHERE user_id = :user_id AND session_id = :session_id ORDER BY id DESC LIMIT 1";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bindParam(":response", $response);
    $update_stmt->bindParam(":user_id", $data->user_id);
    $update_stmt->bindParam(":session_id", $session_id);
    $update_stmt->execute();
    
    http_response_code(200);
    echo json_encode(array(
        "message" => "Chat successful.",
        "response" => $response,
        "session_id" => $session_id
    ));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to process chat. Data is incomplete."));
}

function chatWithGemini($message) {
    // Get API key from environment or config
    $api_key = getenv('GEMINI_API_KEY') ?: 'your_gemini_api_key_here';

    if ($api_key === 'your_gemini_api_key_here' || empty($api_key)) {
        // Fallback responses if no API key
        $responses = array(
            "Selamat datang di Jakarta Luxury AI! Saya adalah asisten virtual yang siap membantu Anda menemukan pengalaman mewah terbaik di Jakarta. Apa yang bisa saya bantu hari ini?",
            "Saya dapat membantu Anda merencanakan perjalanan eksklusif, membuat reservasi di restoran-restoran bergengsi, atau memberikan rekomendasi destinasi wisata premium di Jakarta.",
            "Jakarta memiliki banyak destinasi mewah dari hotel bintang 5 hingga restoran Michelin. Mari saya bantu Anda menemukan pengalaman yang sesuai dengan preferensi Anda.",
            "Untuk informasi lebih lanjut tentang paket wisata mewah atau reservasi eksklusif, silakan beri tahu saya tanggal dan preferensi Anda."
        );
        return $responses[array_rand($responses)];
    }

    // Prepare API request
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $api_key;

    $data = array(
        "contents" => array(
            array(
                "parts" => array(
                    array(
                        "text" => "Anda adalah asisten virtual untuk Jakarta Luxury AI, sebuah platform layanan wisata mewah di Jakarta. Jawab dengan sopan, profesional, dan fokus pada layanan premium Jakarta. Pertanyaan: " . $message
                    )
                )
            )
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        error_log("Gemini API cURL error in chat: " . $curl_error);
        return "Unable to connect to AI service. Please try again later.";
    }

    if ($http_code !== 200) {
        error_log("Gemini API HTTP error in chat: " . $http_code . " Response: " . $response);
        return "AI service is temporarily unavailable. Please contact support.";
    }

    if ($response) {
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Gemini API JSON decode error in chat: " . json_last_error_msg());
            return "Error processing AI response. Please try again.";
        }
        if (isset($result['error'])) {
            error_log("Gemini API error in chat: " . json_encode($result['error']));
            return "AI service returned an error. Please try again.";
        }
        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return $result['candidates'][0]['content']['parts'][0]['text'];
        }
    }

    // Fallback response
    return "Mohon maaf, terjadi gangguan pada sistem kecerdasan buatan kami. Silakan coba lagi nanti atau hubungi customer service kami.";
}
?>
