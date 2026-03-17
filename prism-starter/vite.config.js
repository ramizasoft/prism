const { defineConfig } = require('vite');
const path = require('path');

const preset = (name) =>
    path.resolve(`vendor/ramizasoft/prism/resources/assets/css/presets/${name}.css`);

module.exports = defineConfig({
    build: {
        manifest: true,
        outDir: path.resolve('source/assets/build'),
        emptyOutDir: false,
        rollupOptions: {
            input: {
                clinical: preset('clinical'),
                'clinical-precision': preset('clinical-precision'),
                'clinical-lab': preset('clinical-lab'),
                'clinical-sport': preset('clinical-sport'),
                playful: preset('playful'),
                'playful-paws': preset('playful-paws'),
                'playful-boing': preset('playful-boing'),
                'playful-threads': preset('playful-threads'),
                luxury: preset('luxury'),
                'luxury-noir': preset('luxury-noir'),
                'luxury-velvet': preset('luxury-velvet'),
                'luxury-atelier': preset('luxury-atelier'),
                organic: preset('organic'),
                'organic-moss': preset('organic-moss'),
                'organic-apothecary': preset('organic-apothecary'),
                'organic-farmstead': preset('organic-farmstead'),
                eco: preset('eco'),
                'eco-clean-minimal': preset('eco-clean-minimal'),
                'eco-kraft': preset('eco-kraft'),
            },
            output: {
                entryFileNames: '[name].[hash].js',
                assetFileNames: '[name].[hash].[ext]',
            },
        },
    },
});

