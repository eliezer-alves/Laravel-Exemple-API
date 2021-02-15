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
        path: '/ramo-atividade',
        name: 'ramo-atividade',
        component: () => import('./components/RamoAtividade.vue')
    }
]
