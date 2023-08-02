import { createRouter, createWebHistory } from 'vue-router'

const routes = [{
    path: '/admin/login',
    component: () =>
        import ('../components/admin-panel/Auth/LogIn.vue'),
    name: 'admin.login',
}, {
    path: '/admin',
    component: () =>
        import ('../components/admin-panel/Dashboard.vue'),
    name: 'admin.dashboard',
}, {
    path: '/admin/chat-request',
    component: () =>
        import ('../components/admin-panel/ChatRequest/Edit.vue'),
    name: 'admin.chat-request.edit',
}, {
    path: '/admin/users',
    component: () =>
        import ('../components/admin-panel/Users/Index.vue'),
    name: 'admin.users.index',
}, {
    path: '/admin/coupons',
    component: () =>
        import ('../components/admin-panel/Coupons/Index.vue'),
    name: 'admin.coupons.index',
}, {
    path: '/admin/content',
    component: () =>
        import ('../components/admin-panel/Content/Edit.vue'),
    name: 'admin.content.edit',
}, ]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (!localStorage.getItem('auth') &&
        to.name != 'admin.login'
    ) {
        return next({ name: 'admin.login' })
    }

    if (localStorage.getItem('auth') &&
        to.name == 'admin.login') {
        return next({ name: 'admin.dashboard' })
    }

    return next()
})

export default router