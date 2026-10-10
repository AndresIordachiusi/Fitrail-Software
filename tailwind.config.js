import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                base: "#0A0A0F",
                surface: "#111118",
                elevated: "#1A1A24",
                border: "#2A2A38",
                accent: "#6EE7F7",
                "accent-orange": "#F97316",
                muted: "#50506A",
                text: "#F4F4F5",
                "text-soft": "#A1A1AA",
            },
            fontFamily: {
                sans: ["Geist", ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                xl: "0.875rem",
                "2xl": "1rem",
            },
            boxShadow: {
                panel: "0 10px 30px rgba(0, 0, 0, 0.35)",
            },
        },
    },

    plugins: [forms],
};
