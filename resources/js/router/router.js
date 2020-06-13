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
import CustomerInvoiceViewDocket from "../components/customers/CustomerInvoiceViewDocket";

import CreateQuote from "../components/quotes/CreateQuote";
import Quotes from "../components/quotes/Quotes";
import EditQuote from "../components/quotes/EditQuote";

import CreateShipment from "../components/shipments/CreateShipment";
import Shipments from "../components/shipments/Shipments";
import EditShipment from "../components/shipments/EditShipment";


import CreateStaff from "../components/staff/CreateStaff";
import Staff from "../components/staff/Staff";
import EditStaff from "../components/staff/EditStaff";

import GeneralReports from "../components/reports/GeneralReports";
import PaymentLog from "../components/reports/PaymentLog";
import DeliveryReports from "../components/reports/DeliveryReports";

import Settings from "../components/settings/Settings";
import { LayoutPlugin } from 'bootstrap-vue';

// customer dashboard
import CustomerDashboardView from '../components/customer-components/CustomerDashboardView'
import CustomerDashboardInvoice from '../components/customer-components/CustomerDashboardInvoice'
import CustomerDashboardQuote from '../components/customer-components/CustomerDashboardQuote'
import CustomerDashboardQuoteView from '../components/customer-components/CustomerDashboardQuoteView'
import CustomerDashboardInvoiceView from '../components/customer-components/CustomerDashboardInvoiceView'
import CustomerDashboardDocketView from '../components/customer-components/CustomerDashboardDocketView'
import CustomerTrackShipment from '../components/customer-components/CustomerTrackShipment'



// import Login from "../components/auth/Login.vue";

Vue.use(VueRouter)

const routes = [
    { path: '/admin', component: Analytics, },

    { path: '/admin/customers/create', component: CreateCustomer },
    { path: '/admin/customers/:id', component: ViewCustomer, props: true },
    { path: '/admin/customers/:id/invoice', component: CustomerInvoice },
    { path: '/admin/customers/:id/quotes', component: CustomerQuote },
    { path: '/admin/customers/:id/quotes/:quote_id/view', component: CustomerQuoteView },
    { path: '/admin/customers/:id/invoices/:invoice_id/view', component: CustomerInvoiceView, meta: { reuse: false } },
    { path: '/admin/customers/:id/invoices/:invoice_id/view/docket', component: CustomerInvoiceViewDocket },


    // { path: '/admin/login', component: Login },


    { path: '/admin/customers', component: Customer },

    { path: '/admin/quotes/create', component: CreateQuote },
    { path: '/admin/quotes', component: Quotes },
    { path: '/admin/quotes/:quote_id/edit', component: EditQuote },

    { path: '/admin/shipments', component: Shipments },
    { path: '/admin/shipments/create', component: CreateShipment },
    { path: '/admin/shipments/:shipment_id/edit', component: EditShipment },

    { path: '/admin/staff/create', component: CreateStaff },
    { path: '/admin/staff', component: Staff },
    { path: '/admin/staff/:staff_id/edit', component: EditStaff },

    { path: '/admin/reports', component: GeneralReports },
    { path: '/admin/payment_log', component: PaymentLog },
    { path: '/admin/delivery_reports', component: DeliveryReports },

    { path: '/admin/settings', component: Settings },


    // Customer Dashboard
    { path: '/customer', component: CustomerDashboardInvoice },
    { path: '/customer/edit', component: CustomerDashboardView },
    { path: '/customer/quote', component: CustomerDashboardQuote },
    { path: '/customer/quote/:quote_id/view', component: CustomerDashboardQuoteView },
    { path: '/customer/invoice/:invoice_id/view', component: CustomerDashboardInvoiceView },
    { path: '/customer/invoice/:invoice_id/docket/view', component: CustomerDashboardDocketView },
    {
        path: '/customer/track/shipment', component: CustomerTrackShipment,
    },
]


const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history',
})


export default router;