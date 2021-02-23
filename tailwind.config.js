const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundImage: theme => ({
                "background-agil": "url('/images/texturaBackgroundAgil.png')"
            }),
        },
        backgroundColor: theme => ({
            ...theme('colors'),
            'primary': '#3490dc',
            'secondary': '#ffed4a',
            'danger': '#e3342f',
            'teal': '#008080'
        })

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
