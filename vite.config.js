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
                playful: path.resolve('resources/assets/css/presets/playful.css'),
                luxury: path.resolve('resources/assets/css/presets/luxury.css'),
                organic: path.resolve('resources/assets/css/presets/organic.css'),
            },
            output: {
                entryFileNames: '[name].[hash].js',
                assetFileNames: '[name].[hash].[ext]',
            },
        },
    },
});

