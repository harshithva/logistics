import Vue from 'vue'
import VueRouter from 'vue-router'

import Analytics from "../components/Analytics";
import Customer from "../components/customer/Customer";
import CreateCustomer from "../components/customer/CreateCustomer";
import Shipment from "../components/shipments/Shipment";

Vue.use(VueRouter)

const routes = [
    { path: '/admin', component: Analytics },
    { path: '/admin/customers/create', component: CreateCustomer },
    { path: '/admin/customers', component: Customer },
    { path: '/admin/shipments/create', component: Shipment },
]


const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})


export default router;