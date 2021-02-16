module.exports = [
    {
        path: '*',
        component: () => import('./components/NotFound.vue')
    },
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
        path: '/solicitacao',
        name: 'solicitacao',
        component: () => import('./components/Solicitacao.vue')
    },
    {
        path: '/atividade-comercial',
        name: 'atividade-comercial',
        component: () => import('./components/AtividadeComercial.vue')
    }
]
