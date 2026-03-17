import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        manifest: true,
        outDir: path.resolve('source/assets/build'),
        emptyOutDir: false,
        rollupOptions: {
            input: {
                clinical: path.resolve('resources/assets/css/presets/clinical.css'),
                'clinical-precision': path.resolve('resources/assets/css/presets/clinical-precision.css'),
                'clinical-lab': path.resolve('resources/assets/css/presets/clinical-lab.css'),
                'clinical-sport': path.resolve('resources/assets/css/presets/clinical-sport.css'),
                playful: path.resolve('resources/assets/css/presets/playful.css'),
                'playful-paws': path.resolve('resources/assets/css/presets/playful-paws.css'),
                'playful-boing': path.resolve('resources/assets/css/presets/playful-boing.css'),
                'playful-threads': path.resolve('resources/assets/css/presets/playful-threads.css'),
                luxury: path.resolve('resources/assets/css/presets/luxury.css'),
                'luxury-noir': path.resolve('resources/assets/css/presets/luxury-noir.css'),
                'luxury-velvet': path.resolve('resources/assets/css/presets/luxury-velvet.css'),
                'luxury-atelier': path.resolve('resources/assets/css/presets/luxury-atelier.css'),
                organic: path.resolve('resources/assets/css/presets/organic.css'),
                'organic-moss': path.resolve('resources/assets/css/presets/organic-moss.css'),
                'organic-apothecary': path.resolve('resources/assets/css/presets/organic-apothecary.css'),
                'organic-farmstead': path.resolve('resources/assets/css/presets/organic-farmstead.css'),
                eco: path.resolve('resources/assets/css/presets/eco.css'),
                'eco-clean-minimal': path.resolve('resources/assets/css/presets/eco-clean-minimal.css'),
                'eco-kraft': path.resolve('resources/assets/css/presets/eco-kraft.css'),
            },
            output: {
                entryFileNames: '[name].[hash].js',
                assetFileNames: '[name].[hash].[ext]',
            },
        },
    },
});

