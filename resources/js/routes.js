module.exports = [
    {
        path: '*',
        component: () => import('./components/NotFound.vue')
    },
    {
        path: '/',
        component: () => import('./components/Home.vue')
    },
    {
        path: '/home',
        name: 'home',
        component: () => import('./components/Home.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./components/Login.vue')
    },
    {
        path: '/atividade-comercial',
        name: 'atividade-comercial',
        component: () => import('./components/AtividadeComercial.vue')
    }
]
