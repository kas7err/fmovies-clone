const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
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
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                amber: colors.amber,
                black: '#000',
                blue: colors.blue,
                blueGray: colors.blueGray,
                coolGray: colors.coolGray,
                cyan: colors.cyan,
                emerald: colors.emerald,
                fuchsia: colors.fuchsia,
                gray: colors.gray,
                green: colors.green,
                indigo: colors.indigo,
                lime: colors.lime,
                orange: colors.orange,
                pink: colors.pink,
                purple: colors.purple,
                red: colors.red,
                rose: colors.rose,
                teal: colors.teal,
                trueGray: colors.trueGray,
                violet: colors.violet,
                warmGray: colors.warmGray,
                white: '#FFF',
                yellow: colors.yellow,
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
