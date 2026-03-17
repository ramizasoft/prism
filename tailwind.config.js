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
                sans: ['var(--prism-font-body, Inter)', ...defaultTheme.fontFamily.sans],
                display: ['var(--prism-font-display, ui-serif)', ...defaultTheme.fontFamily.serif],
            },
        },
    },
    plugins: [],
};

