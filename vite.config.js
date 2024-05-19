import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // refresh: true, // default is true
            refresh: 'app/Livewire/**', // refresh when Livewire component is updated
        }),
    ],
});
