const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
        'light',
          {
            'tenant-one': {
                "color-scheme": "light",
                primary: "#e0a82e",
                "primary-content": "#181830",
                secondary: "#f9d72f",
                "secondary-content": "#181830",
                accent: "#181830",
                neutral: "#181830",
                "base-100": "#ffffff",
            },
            'tenant-two': {
                "color-scheme": "light",
                primary: "#65c3c8",
                secondary: "#ef9fbc",
                accent: "#eeaf3a",
                neutral: "#291334",
                "base-100": "#faf7f5",
                "base-200": "#efeae6",
                "base-300": "#e7e2df",
                "base-content": "#291334",
                "--rounded-btn": "1.9rem",
                "--tab-border": "2px",
                "--tab-radius": ".5rem",
            },
          },
        ],
    },

    plugins: [
        require("daisyui"),
        require('@tailwindcss/forms')
    ],
};
