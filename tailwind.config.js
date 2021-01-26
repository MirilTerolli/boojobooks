const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
        // Other plugins
        require('tailwindcss-animatecss')({
            classes: ['animate__animated', 'animate__fadeIn', 'animate__bounceIn', 'animate__lightSpeedOut', 'animate-pulse'],
            settings: {
                animatedSpeed: 1000,
                heartBeatSpeed: 1000,
                hingeSpeed: 2000,
                bounceInSpeed: 750,
                bounceOutSpeed: 750,
                animationDelaySpeed: 1000
            },
            variants: ['responsive', 'hover', 'reduced-motion'],
        }),
    ]
};
