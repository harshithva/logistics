import Vue from 'vue'
import VueRouter from 'vue-router'

import Analytics from "../components/Analytics";
import Customer from "../components/customer/Customer";
import CreateCustomer from "../components/customer/CreateCustomer";
import CreateShipment from "../components/shipments/CreateShipment";
import CreateQuote from "../components/quotes/CreateQuote";
import Quotes from "../components/quotes/Quotes";

Vue.use(VueRouter)

const routes = [
    { path: '/admin', component: Analytics },
    { path: '/admin/customers/create', component: CreateCustomer },
    { path: '/admin/customers', component: Customer },
    { path: '/admin/shipments/create', component: CreateShipment },
    { path: '/admin/quotes/create', component: CreateQuote },
    { path: '/admin/quotes', component: Quotes },
]


const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})


export default router;