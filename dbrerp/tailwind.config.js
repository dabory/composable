module.exports = {
    prefix: 'tw-',
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",

        "./public/themes/**/*.blade.php",
        "./public/themes/**/*.js",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            height: {
                '112': '28rem',
            },
            width: {
                '128': '32rem',
            }
        },
    },
    plugins: [],
}


