/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        colors: {
            black: "#1a1e21",
            grey: "#d9d9d9",
            "grey-dark": "#888888",
            purple: "#5c53fa",
            "purple-light": "#d1cffe",
            white: "#FFFFFF",
            red: "#FF3333",
            yellow: "#f0ad4e",
            green: "#66bb6a",
        },
        extend: {
            minWidth: {
                "2/5": "40%",
            },
        },
    },
    plugins: [],
};
