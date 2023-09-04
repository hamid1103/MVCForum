import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const projectRootDir = resolve(__dirname);
import {resolve} from 'path'
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte({
            /* plugin options */
        })
    ],
    optimizeDeps: {
        include: [
            '@inertiajs/inertia',
            '@inertiajs/inertia-svelte',
        ]
    },
    resolve: {
        alias: {
            '@': resolve(projectRootDir, 'resources/js'),
            '~': resolve(projectRootDir, 'resources'),
        },
        extensions: ['.js', '.svelte', '.json'],
    }
});
