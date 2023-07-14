import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path');
export default defineConfig({
    plugins: [
        laravel([
            'resources/scss/app.scss',
            'resources/js/app.js',
        ]),
    ],
    resolve: {
        alias: {
        '~resources': '/resources/',
        '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
        },
});

