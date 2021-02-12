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
            })
        }
    },
    variants: {
        extend: {}
    },
    plugins: []
};
