import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/sass/panel.scss',
                'resources/sass/cart.scss',
                'resources/sass/estilos.scss',
                'resources/sass/select_empresa.scss',
                'resources/sass/pantalla_de_carga.scss',
                'resources/js/app2.js',
                'resources/js/cart.js',
                'resources/js/products.js',
            ],
            refresh: true,
        }),
    ],
});
