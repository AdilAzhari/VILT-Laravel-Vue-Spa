import '../css/app.css';
import './bootstrap';

import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {ZiggyVue} from 'ziggy-js';
import MainLayout from './Layouts/MainLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        );

        return page.then((module) => {
            module.default.layout = module.default.layout || MainLayout;
            return module;
        });
    },
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then(r => {
    r.app.component('MainLayout', MainLayout);
});

