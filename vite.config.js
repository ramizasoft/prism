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
            },
            output: {
                entryFileNames: '[name].[hash].js',
                assetFileNames: '[name].[hash].[ext]',
            },
        },
    },
});

