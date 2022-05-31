const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./assets/js/**/*.{js,vue,ts,jsx,tsx}",
        "./templates/**/*.{html,twig}"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
