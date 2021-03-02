const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

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
            backgroundImage: theme => ({
                "background-agil": "url('/images/texturaBackgroundAgil.png')"
            }),
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                teal: colors.teal,
            },
            opacity: ['disabled'],
        },

    },

    variants: {
        extend: {

        },
    },

    plugins: [],
};
