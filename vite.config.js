import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'

Alpine.plugin(mask);

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
