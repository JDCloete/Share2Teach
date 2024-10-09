// Styles
import './bootstrap';
import '../css/app.css';

// Vue
import { createApp, h } from 'vue';
import AppFrameworkPlugin from 'inertia-app-framework-vuetify';

// Inertia
import { createInertiaApp } from '@inertiajs/vue3';
import { InertiaProgress } from '@inertiajs/progress';

// Vite
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// Ziggy
import { ZiggyVue } from 'ziggy-js';

// Vuetify
import 'vuetify/styles'; // Import Vuetify styles
import { createVuetify } from 'vuetify'; // Import Vuetify as named export
import * as components from 'vuetify/components'; // Import Vuetify components
import * as directives from 'vuetify/directives'; // Import Vuetify directives

// Mitt
import mitt from 'mitt';

const vuetify = createVuetify({
    components,
    directives,
});

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vue = createApp({ render: () => h(App, props) })
            .use(vuetify) // Use the Vuetify instance
            .use(plugin)
            .use(AppFrameworkPlugin)
            .use(ZiggyVue);

        vue.config.globalProperties.$route = (name, params, absolute) => route(name, params, absolute, ZiggyVue);

        vue.config.globalProperties.$http = axios.create();

        // Initialize mitt
        const emitter = mitt();
        vue.config.globalProperties.emitter = emitter;

        return vue.mount(el);
    },
}).then(() => {});

InertiaProgress.init({ color: '#151515' });
