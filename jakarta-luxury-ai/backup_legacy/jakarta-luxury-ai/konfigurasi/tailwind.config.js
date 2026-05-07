/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./sumber/**/*.{js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'luxury-gold': '#C5A059',
                'luxury-dark': '#0A0A0A',
                'luxury-card': '#141414',
                'luxury-text': '#E5E5E5',
            },
            fontFamily: {
                serif: ['Playfair Display', 'serif'],
                sans: ['Inter', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
