import Vue from 'vue'
import VueRouter from 'vue-router'

import Analytics from "../components/Analytics";
import Customer from "../components/customer/Customer";
import CreateCustomer from "../components/customer/CreateCustomer";

Vue.use(VueRouter)

const routes = [
    { path: '/admin', component: Analytics },
    { path: '/admin/customers/create', component: CreateCustomer },
    { path: '/admin/customers', component: Customer }
]


const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})


export default router;