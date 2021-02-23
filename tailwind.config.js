module.exports = {
    purge: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue"
    ],
    darkMode: false, // or 'media' or 'class'
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
        extend: {}
    },
    plugins: []
};
