import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                audioWide: ["Audiowide", "serif"],
                nunito: ["Nunito", "serif"],
                poppins: ["Poppins", "serif"],
            },
            colors: {
                base: "#11121a",
                line: "#42434a",
                hover: "#222533",
                text: "#e6e6ef",
                accent: "#5e63ff",
                secondary: "#b0b3c1",
            },
            rotate: {
                "y-180": "180deg",
            },
        },
    },
    plugins: [],
};
