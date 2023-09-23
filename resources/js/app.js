import './bootstrap';
import { createInertiaApp } from '@inertiajs/svelte'
import DefaultLayout from "@/Layout/DefaultLayout.svelte";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        let page = pages[`./Pages/${name}.svelte`]
        return { default: page.default, layout: page.layout || DefaultLayout}
        return page
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
})
