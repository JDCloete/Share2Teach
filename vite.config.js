import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        // Increase the chunk size warning limit (optional)
        chunkSizeWarningLimit: 1000,

        // Manual chunking to split large dependencies into separate chunks
        rollupOptions: {
            output: {
                manualChunks: {
                    vue: ['vue'],
                    vuetify: ['vuetify'],
                    inertia: ['@inertiajs/vue3'],
                },
            },
        },
    },
});
