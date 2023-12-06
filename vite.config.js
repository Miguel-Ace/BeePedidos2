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
                'resources/js/app.js',
                'resources/js/app2.js',
                'resources/js/products.js',
                'resources/js/cart.js',
                'resources/js/add_producto.js',
                'resources/js/enviar_formulario.js',
                'resources/js/botones_cart.js',
            ],
            refresh: true,
        }),
    ],
});
