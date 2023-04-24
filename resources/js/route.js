import Dashboard from './components/Dashboard.vue'
import Users from './components/Users.vue'
import Customers from './pages/Customers.vue'
import Tickets from './pages/Tickets.vue'
import Payments from './pages/Payments.vue'

export default [

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