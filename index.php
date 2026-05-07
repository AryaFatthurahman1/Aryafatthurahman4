<?php
/**
 * Luxury Gateway - AntiGravity Ecosystem
 * Redirects to the unified luxury dashboard after a premium experience.
 */
if (empty($_GET['q'])) {
    // Show luxury splash for 2 seconds then redirect
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AntiGravity | Luxury Gateway</title>
        <link rel="stylesheet" href="shared/css/luxury.css">
        <style>
            :root {
                --lux-bg: #010309;
                --lux-bg-alt: #050812;
                --lux-glass: rgba(10, 15, 30, 0.6);
                --lux-border: rgba(255, 255, 255, 0.07);
                --lux-border-bright: rgba(34, 211, 238, 0.25);
                --lux-cyan: #22d3ee;
                --lux-gold: #fbbf24;
                --lux-purple: #a855f7;
                --lux-emerald: #10b981;
                --lux-rose: #f43f5e;
                --lux-text: #f8fafc;
                --lux-text-dim: #94a3b8;
                --lux-text-dark: #475569;
                --lux-radius: 20px;
                --lux-transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
            }
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                background-color: var(--lux-bg);
                color: var(--lux-text);
                font-family: 'Plus Jakarta Sans', sans-serif;
                line-height: 1.6;
                overflow-x: hidden;
                -webkit-font-smoothing: antialiased;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .lux-splash {
                padding: 40px;
                background: var(--lux-glass);
                backdrop-filter: blur(25px);
                border: 1px solid var(--lux-border);
                border-radius: var(--lux-radius);
                max-width: 500px;
            }
            .lux-logo {
                font-size: 48px;
                font-weight: 900;
                letter-spacing: -2px;
                margin-bottom: 20px;
                background: linear-gradient(to bottom, #fff 40%, rgba(255,255,255,0.5));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
                position: relative;
            }
            .lux-logo .lux-grad-text {
                background: linear-gradient(90deg, var(--lux-cyan), var(--lux-purple), var(--lux-rose));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .lux-tagline {
                font-size: 18px;
                color: var(--lux-text-dim);
                margin-bottom: 30px;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            .lux-progress {
                width: 100%;
                height: 4px;
                background: rgba(255,255,255,0.1);
                border-radius: 2px;
                overflow: hidden;
                margin-top: 20px;
            }
            .lux-progress-bar {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, var(--lux-cyan), var(--lux-purple));
                transition: width 2s ease;
            }
            .lux-footer {
                margin-top: 30px;
                font-size: 12px;
                color: var(--lux-text-dark);
                letter-spacing: 1px;
            }
        </style>
    </head>
    <body>
        <div class="lux-splash">
            <div class="lux-logo">Anti<span class="lux-grad-text">Gravity</span></div>
            <div class="lux-tagline">Unified Luxury Ecosystem</div>
            <div class="lux-progress"><div class="lux-progress-bar" id="progress"></div></div>
            <div class="lux-footer">Redirecting to the Quantum Nexus...</div>
        </div>
        <script>
            // Animate progress bar
            setTimeout(() => {
                document.getElementById('progress').style.width = '100%';
            }, 100);
            // Redirect after 2 seconds
            setTimeout(() => {
                window.location.href = '/antigravity-superhub/';
            }, 2000);
        </script>
    </body>
    </html>
    <?php
    exit;
}

// Handle query parameters
if (!empty($_GET['q'])) {
    $query = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');
    switch ($query) {
        case 'info':
            phpinfo();
            exit;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Invalid query parameter.";
            exit;
    }
}
?>