import Dashboard from './components/Dashboard.vue'
import Users from './components/Users.vue'
import Register from './components/Login.vue'
import Login from './components/Register.vue'
import Customers from './pages/Customers.vue'
import Tickets from './pages/Tickets.vue'
import Payments from './pages/Payments.vue'

export default [

    {
        path:'/register',
        name:'register',
        component: Register,
    },

    {
        path:'/login',
        name:'login',
        component: Login,
    },

    {
        path:'/dashboard',
        name:'dashboard',
        component: Dashboard,
    },

    {
        path:'/users',
        name:'users',
        component: Users,
    },

    {
        path:'/customers',
        name:'customers',
        component: Customers,
    },

    {
        path:'/tickets',
        name:'tickets',
        component: Tickets,
    },

    {
        path:'/payments',
        name:'payments',
        component: Payments,
    }


]