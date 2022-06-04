import DefaultLayout from '../layouts/default.vue';
import AuthLayout from '../layouts/auth.vue';
import Auth from '../pages/auth.vue';
import Store from '../pages/store.vue';
import Manufacturer from '../pages/manufacturer.vue';

const routes = [
    {
        path: '/',
        name: 'layout',
        component: DefaultLayout,
        children: [
            {name: 'auth', path: '', component: Auth}
        ]
    }, {
        path: '/',
        name: 'layout',
        component: AuthLayout,
        children: [
            {name: 'store', path: 'store', component: Store},
            {name: 'manufacturer', path: 'manufacturer', component: Manufacturer}
        ]
    }
];

export default routes;