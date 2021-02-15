module.exports = [
    {
        path: '/',
        name: 'home',
        component: () => import('./components/Home.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./components/Login.vue')
    },
    {
        path: '*',
        name: 'login',
        component: () => import('./components/NotFound.vue')
    },
]
