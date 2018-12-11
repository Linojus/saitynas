import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import Topic from './pages/Topic'
import TopicCreate from './pages/TopicCreate'
import TopicEdit from './pages/TopicEdit'

// Routes
//path root '/saitynas/public'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    // ADMIN ROUTES
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: AdminDashboard,
        meta: {
            auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        }
    },
    //BOTH ROLES ROUTES

    {
        path: '/topics/new',
        name: 'topicCreate',
        component: TopicCreate,
        meta: {
            auth: true
        }
    },
    {
        path: '/topics/:topic_id/edit',
        name: 'topicEdit',
        props: true,
        component: TopicEdit,
        meta: {
            auth: true
        }
    },
    {
        path: '/topics/:topic_id',
        name: 'topic',
        props: true,
        component: Topic,
        meta: {
            auth: true
        }
    },
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    base: '/saitynas/public/',
    routes,
})
export default router