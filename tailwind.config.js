const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './source/**/*.{blade.php,md,html}',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--prism-color-primary)',
                secondary: 'var(--prism-color-secondary)',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};

