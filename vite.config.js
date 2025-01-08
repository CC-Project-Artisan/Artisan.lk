import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/welcome.css',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/welcome.js',
                'resources/css/banner.css',
                'resources/js/banner.js',
                'resources/css/feature.css',
                'resources/css/category.css',
                'resources/css/dashboard.css',
                'resources/js/dashboard.js',
                'resources/css/product_list.css',
                'resources/js/product_list.js',
                'resources/css/exhibition.css',
                'resources/css/product_details.css',
                'resources/css/cart.css',
                'resources/css/component.css',
                'resources/css/preview.css',
                'resources/css/chat.css',
            ],
            refresh: true,
        }),
    ],
});
