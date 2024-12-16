import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'], // Sesuaikan path dengan proyek Anda
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Direktori output hasil build
    }
});
