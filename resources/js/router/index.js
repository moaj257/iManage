import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from './routes';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('_token');
    if (!loggedIn && to.path !== '/') {
        next({name: 'auth'});
        return
    } else if(loggedIn && to.path === '/') {
        next({name: 'store'});
        return
    }
    next();
});

export default router;