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
        path: '/login-admin',
        name: 'login-admin',
        component: () => import('./components/LoginAdmin.vue')
    },
    {
        path: '/cadastro-cliente',
        name: 'cadastro-cliente',
        component: () => import('./components/CadastroCliente.vue')
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
