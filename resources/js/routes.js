module.exports = [
    {
        path: '/',
        name: 'index',
        component: () => import('./routes/Index.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./routes/Login.vue')
    }
]
