import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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

            colors: {
                moradoClaro: {
                    50: "#f3f5fb",
                    100: "#e4e8f5",
                    200: "#cfd7ee",
                    300: "#afbde1",
                    400: "#889ad2",
                    500: "#6c7cc5",
                    600: "#5963b7",
                    700: "#484d9b", //original
                    800: "#444689",
                    900: "#3a3e6e",
                    950: "#272844",
                },
            
                moradoFuerte: {
                    50: '#f5f4fa',
                    100: '#e8e6f3',
                    200: '#d7d3ea',
                    300: '#bab5db',
                    400: '#9a91c9',
                    500: '#8777ba',
                    600: '#7964ac',
                    700: '#71599c',
                    800: '#5f4c81',
                    900: '#4a3d62', //original
                    950: '#322a41',
                },
                
            },
        },
    },

    plugins: [forms],
};
