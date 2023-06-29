import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/css/app.css',
              'resources/js/app.js',,
              'resources/js/school/index.js',
              'resources/js/school/exam/index.js',
              'resources/js/school/subject/index.js'
            ],
            refresh: true,
        }),
    ],
});
