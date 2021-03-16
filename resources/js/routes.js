module.exports = [

    {
        path: '/app/',
        component: () => import('./components/Home.vue')
    },
    {
        path: '/app/home',
        name: 'home',
        component: () => import('./components/Home.vue'),
        props: true
    },
    {
        path: '/app/login',
        name: 'login',
        component: () => import('./components/Login.vue'),
        props: true
    },
    {
        path: '/app/login-admin',
        name: 'login-admin',
        component: () => import('./components/LoginAdmin.vue')
    },
    {
        path: '/app/cadastro-cliente',
        name: 'cadastro-cliente',
        component: () => import('./components/cad.cliente/FirstStep.vue')
    },
    {
        path: '/app/cadastro-cliente-2',
        name: 'cadastro-cliente-2',
        component: () => import('./components/cad.cliente/SecondStep.vue')
    },
    {
        path: '/app/cadastro-cliente-3',
        name: 'cadastro-cliente-3',
        component: () => import('./components/cad.cliente/ThirdStep.vue')
    },
    {
        path: '/app/solicitacao',
        name: 'solicitacao',
        component: () => import('./components/cad.solicitacao/FirstStep.vue')
    },
    {
        path: '/app/solicitacao-2',
        name: 'solicitacao-2',
        component: () => import('./components/cad.solicitacao/SecondStep.vue')
    },
    {
        path: '/app/solicitacao-3',
        name: 'solicitacao-3',
        component: () => import('./components/cad.solicitacao/ThirdStep.vue')
    },
    {
        path: '/app/solicitacao-4',
        name: 'solicitacao-4',
        component: () => import('./components/cad.solicitacao/FouthStep.vue')
    },
    {
        path: '/app/atividade-comercial',
        name: 'atividade-comercial',
        component: () => import('./components/AtividadeComercial.vue')
    },
    {
        path: '*',
        component: () => import('./components/NotFound.vue')
    },
]
