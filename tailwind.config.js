import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                neutral: {
                    50: '#F8F8F8', // Lighter almost-white for backgrounds
                    100: '#F0F0F0', // Light gray for sections
                    200: '#E0E0E0',
                    300: '#CCCCCC',
                    400: '#A3A3A3',
                    500: '#7F7F7F', // Standard text
                    600: '#666666',
                    700: '#4D4D4D',
                    800: '#333333', // Dark text, backgrounds
                    900: '#1A1A1A', // Very dark for hero/footer
                    950: '#0A0A0A', // Almost black
                },
                accent: {
                    DEFAULT: '#D4A017', // Original Gold-500 as default
                    50: '#FFFBEB',
                    100: '#FAEED1',
                    200: '#F9E0B2',
                    300: '#F5CC73',
                    400: '#E6B325', // Original Gold-400
                    500: '#D4A017', // Original Gold-500
                    600: '#B78C14', // Original Gold-600
                    700: '#9A7612', // Original Gold-700
                    800: '#7E600F',
                    900: '#624A0C',
                },
                gold: {
                    50: '#FFFBEA',
                    100: '#FFF7C3',
                    200: '#FFF09E',
                    300: '#FFE678',
                    400: '#FFDB52',
                    500: '#FFD12C', // A mid-range gold
                    600: '#CCAA23', // Your primary gold for buttons/links
                    700: '#99801A',
                    800: '#665511',
                    900: '#332B08',
                },
            },
            // Update font families
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', 'serif'],
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.6s ease-out forwards',
            },
            keyframes: {
                'fade-in-up': {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(20px)',
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
            },
        },
    },

    plugins: [forms],
};
