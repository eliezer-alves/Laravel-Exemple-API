const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
const forms = require('@tailwindcss/forms');

module.exports = {
    darkMode: 'media',//'media' |'class',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            maxHeight: {
                '0': '0',
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                'full': '100%',
            },
            backgroundImage: theme => ({
                "background-agil": "url('/images/texturaBackgroundAgil.png')"
            }),
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                teal: colors.teal,
            },

        },

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [],
};
