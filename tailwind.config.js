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
            colors: {
                background: '#f7faf3',
                surface: '#f7faf3',
                'surface-container': '#ebefe8',
                'surface-container-low': '#f1f5ed',
                'surface-container-high': '#e6e9e2',
                'surface-container-highest': '#e0e4dc',
                'surface-container-lowest': '#ffffff',
                'surface-variant': '#e0e4dc',
                outline: '#707a6f',
                'outline-variant': '#bfc9bd',
                primary: '#004c22',
                'primary-container': '#166534',
                'on-primary': '#ffffff',
                'on-primary-container': '#d6f7dc',
                secondary: '#006d36',
                'secondary-container': '#6dfe9c',
                'on-secondary-container': '#003918',
                error: '#ba1a1a',
                'error-container': '#ffdad6',
                'on-surface': '#181d18',
                'on-surface-variant': '#404940',
            },
            spacing: {
                gutter: '16px',
                xs: '4px',
                sm: '8px',
                md: '16px',
                lg: '24px',
                xl: '32px',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
