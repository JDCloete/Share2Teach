import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import App from './Pages/App.vue'; // Adjust this if necessary

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`] || App; // Fallback to App.vue
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
