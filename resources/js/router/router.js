import Vue from 'vue'
import VueRouter from 'vue-router'

import Analytics from "../components/Analytics";

import Customer from "../components/customers/Customer";
import ViewCustomer from "../components/customers/ViewCustomer";
import CustomerInvoice from "../components/customers/CustomerInvoice";
import CreateCustomer from "../components/customers/CreateCustomer";
import CustomerQuote from "../components/customers/CustomerQuote";
import CustomerQuoteView from "../components/customers/CustomerQuoteView";
import CustomerInvoiceView from "../components/customers/CustomerInvoiceView";

import CreateQuote from "../components/quotes/CreateQuote";
import Quotes from "../components/quotes/Quotes";

import CreateShipment from "../components/shipments/CreateShipment";
import Shipments from "../components/shipments/Shipments";


import CreateStaff from "../components/staff/CreateStaff";
import Staff from "../components/staff/Staff";

import GeneralReports from "../components/reports/GeneralReports";
import PaymentLog from "../components/reports/PaymentLog";
import DeliveryReports from "../components/reports/DeliveryReports";

import Settings from "../components/settings/Settings";

Vue.use(VueRouter)

const routes = [
    { path: '/admin', component: Analytics },

    { path: '/admin/customers/create', component: CreateCustomer },
    { path: '/admin/customers/:id', component: ViewCustomer },
    { path: '/admin/customers/:id/invoice', component: CustomerInvoice },
    { path: '/admin/customers/:id/quotes', component: CustomerQuote },
    { path: '/admin/customers/:id/quotes/:id/view', component: CustomerQuoteView },
    { path: '/admin/customers/:id/invoices/:id/view', component: CustomerInvoiceView },
    { path: '/admin/customers', component: Customer },

    { path: '/admin/quotes/create', component: CreateQuote },
    { path: '/admin/quotes', component: Quotes },

    { path: '/admin/shipments', component: Shipments },
    { path: '/admin/shipments/create', component: CreateShipment },

    { path: '/admin/staff/create', component: CreateStaff },
    { path: '/admin/staff', component: Staff },

    { path: '/admin/reports', component: GeneralReports },
    { path: '/admin/payment_log', component: PaymentLog },
    { path: '/admin/delivery_reports', component: DeliveryReports },

    { path: '/admin/settings', component: Settings },
]


const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})


export default router;