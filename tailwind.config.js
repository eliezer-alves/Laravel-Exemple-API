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
        screens: {
            'xsm': {'min': '320px', 'max': '639px'},
            'sm': {'min': '640px', 'max': '767px'},
            'md': {'min': '768px', 'max': '1023px'},
            'lg': '1024px',
        },
        extend: {
            height: {
                '10/12': '83.33%',
                '11/12': '91.16%',
            },
            maxHeight: {
                '0': '0',
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                '10/12': '83.33%',
                '11/12': '91.16%',
                'full': '100%',
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                teal: colors.teal,
            },
            backgroundSize: {
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
            },
            backgroundImage: theme => ({
                "agil": "url('/images/textura.png')"
            }),


        },

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [],
};
