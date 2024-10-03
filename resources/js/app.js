// Styles
import './bootstrap';
import '../css/app.css';

// Vue
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';

// Vuetify
import vuetify from './vuetify';
import 'vuetify/styles';

// Mitt
import mitt from 'mitt';

// Inertia
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';

// Ziggy
//import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import {ZiggyVue} from 'ziggy-js';

// Application name from environment variable
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Create Inertia app
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue', { eager: false })),
    setup({el, App, props, plugin}) {
        const app = createApp({
            render: () => h(App, props),
        })
            .use(vuetify)  // Use Vuetify
            .use(plugin)   // Use Inertia plugin
            .use(ZiggyVue) // Use Ziggy for route handling


        // Initialization of mitt
        app.config.globalProperties.emitter = mitt();

        app.mount(el);

        return app; // Return the app instance
    },
    progress: {
        color: '#4B5563', // Progress bar color
    },
});
