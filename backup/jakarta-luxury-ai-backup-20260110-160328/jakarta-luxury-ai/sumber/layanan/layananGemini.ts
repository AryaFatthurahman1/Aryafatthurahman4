
import { GoogleGenAI, Modality } from "@google/genai";

const API_KEY = import.meta.env?.VITE_GEMINI_API_KEY || '';

export const generateLuxuryImage = async (prompt: string, size: "1K" | "2K" | "4K" = "2K", aspectRatio: "1:1" | "16:9" | "9:16" = "16:9") => {
  if (!API_KEY || API_KEY === 'your_actual_gemini_api_key_here') {
    throw new Error('Gemini API key is not configured properly');
  }

  try {
    const ai = new GoogleGenAI({ apiKey: API_KEY });
    const response = await ai.models.generateContent({
      model: 'gemini-2.0-flash-exp',
      contents: {
        parts: [
          { 
            text: `Create a stunning luxury interior design for Jakarta's elite establishments. ${prompt}. Requirements: ultra-realistic, architectural photography style, dramatic lighting, premium materials (marble, gold, brass, velvet), sophisticated color palette, 8K resolution, professional interior photography. Focus on creating an atmosphere of exclusivity and elegance.` 
          },
        ],
      },
      config: {
        responseModalities: [Modality.IMAGE, Modality.TEXT],
        imageConfig: {
          aspectRatio,
          imageSize: size
        },
      },
    });

    if (!response.candidates || response.candidates.length === 0) {
      throw new Error('No response from AI service');
    }

    for (const part of response.candidates[0]?.content?.parts || []) {
      if (part.inlineData) {
        return `data:image/png;base64,${part.inlineData.data}`;
      }
    }
    throw new Error('No image data in response');
  } catch (error) {
    console.error('Error generating image:', error);
    if (error instanceof Error) {
      throw new Error(`Failed to generate image: ${error.message}`);
    }
    throw new Error('Failed to generate image due to unknown error');
  }
};

export const chatWithConcierge = async (message: string) => {
  if (!API_KEY || API_KEY === 'your_actual_gemini_api_key_here') {
    throw new Error('Gemini API key is not configured properly');
  }

  try {
    const ai = new GoogleGenAI({ apiKey: API_KEY });
    const chat = ai.chats.create({
      model: 'gemini-1.5-pro',
      config: {
        systemInstruction: `Anda adalah Concierge Mewah Jakarta untuk brand "Jakarta Luxury AI". Anda adalah asisten virtual elit yang membantu klien high-end merencanakan pengalaman eksklusif di Jakarta.

Persona:
- Sangat sopan, elegan, dan berkelas
- Berpengetahuan luas tentang tempat-tempat mewah di Jakarta
- Selalu memberikan rekomendasi yang spesifik dan personal
- Menggunakan bahasa Indonesia yang formal namun hangat

Layanan:
- Rekomendasi restoran bintang Michelin
- Reservasi hotel mewah
- Desain interior untuk restoran/hotel
- Pengalaman wisata eksklusif
- Transportasi premium
- Event dan acara khusus

Selalu berikan jawaban yang detail, helpful, dan mencerminkan luxury lifestyle.`,
        temperature: 0.7,
        maxOutputTokens: 1024
      },
    });

    const response = await chat.sendMessage({ message });
    if (!response.text) {
      throw new Error('No text in response');
    }
    return response.text;
  } catch (error) {
    console.error('Error in chat:', error);
    if (error instanceof Error) {
      throw new Error(`Chat failed: ${error.message}`);
    }
    throw new Error('Chat failed due to unknown error');
  }
};

export const searchJakartaTrends = async (query: string) => {
  if (!API_KEY || API_KEY === 'your_actual_gemini_api_key_here') {
    throw new Error('Gemini API key is not configured properly');
  }

  try {
    const ai = new GoogleGenAI({ apiKey: API_KEY });
    const response = await ai.models.generateContent({
      model: "gemini-3-flash-preview",
      contents: query,
      config: {
        tools: [{ googleSearch: {} }],
      },
    });

    if (!response.text) {
      throw new Error('No text in search response');
    }

    return {
      text: response.text,
      sources: response.candidates?.[0]?.groundingMetadata?.groundingChunks || []
    };
  } catch (error) {
    console.error('Error in search:', error);
    if (error instanceof Error) {
      throw new Error(`Search failed: ${error.message}`);
    }
    throw new Error('Search failed due to unknown error');
  }
};

export const generateSpeech = async (text: string) => {
  if (!API_KEY || API_KEY === 'your_actual_gemini_api_key_here') {
    throw new Error('Gemini API key is not configured properly');
  }

  try {
    const ai = new GoogleGenAI({ apiKey: API_KEY });
    const response = await ai.models.generateContent({
      model: "gemini-2.5-flash-preview-tts",
      contents: [{ parts: [{ text }] }],
      config: {
        responseModalities: [Modality.AUDIO],
        speechConfig: {
          voiceConfig: {
            prebuiltVoiceConfig: { voiceName: 'Kore' },
          },
        },
      },
    });

    const audioData = response.candidates?.[0]?.content?.parts?.[0]?.inlineData?.data;
    if (!audioData) {
      throw new Error('No audio data in response');
    }
    return audioData;
  } catch (error) {
    console.error('Error generating speech:', error);
    if (error instanceof Error) {
      throw new Error(`Speech generation failed: ${error.message}`);
    }
    throw new Error('Speech generation failed due to unknown error');
  }
};


