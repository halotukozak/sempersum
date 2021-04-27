const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                mono: ['Hack', ...defaultTheme.fontFamily.mono]
            },
            spacing: {
                128: '32rem',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['checked', 'disabled'],
            borderColor: ['checked'],
            cursor: ['disabled'],
            textColor: ['hover'],
        },
        width: ["responsive", "hover", "focus"],
        textColor: ['dark'],
    },

    darkMode: 'class',

    plugins: [require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],

};

