/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./**/*.{html,js,ts,jsx,tsx}", // scan **everything** in your project
    ],
    theme: {
        extend: {
            fontFamily: {
                roboto: ['Roboto', 'sans-serif'],
            },

        },
        plugins: [],
    }
}
