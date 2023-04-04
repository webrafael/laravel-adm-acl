import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    server: {
        port: 4000,
        host: true,
        hmr: {
            host: 'localhost'
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.ts',
            ],
            refresh: true,
        }),
    ],
});
