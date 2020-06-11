import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({
    namespaced: true,
    state: {
        customers: [],
        errors: [],
        customer: {},
        shipments: [],
        shipment: {},
        balance_amount: {},
        shipment_status: {},
        quote: {},
        quotes: [],
        customer_invoice: {},
        customer_quotes: {},
        dashboard: {},
        staffs: {},
        satff: {}
    },
    getters: {
        getAllCustomers(state) {
            return state.customers
        },
        getAllErrors(state) {

            return state.errors;
        },
        getSingleCustomer(state) {
            return state.customer;
        },
        getAllShipments(state) {
            return state.shipments;
        },
        getSingleShipment(state) {

            return state.shipment;
        },
        getShipmentBalanceAmount(state) {
            return state.balance_amount;
        },
        getShipmentStatus(state) {
            return state.shipment_status;
        },
        getSingleQuote(state) {
            return state.quote;
        },
        getAllQuotes(state) {
            return state.quotes;
        },
        getCustomerInvoices(state) {
            return state.customer_invoice;
        },
        getCustomerQuotes(state) {
            return state.customer_quotes;
        },
        getDashboardDetails(state) {
            return state.dashboard;
        },
        getAllStaffs(state) {
            return state.staffs;
        },
        getSingleStaff(state) {
            return state.staff;
        },
    },
    mutations: {
        retrieveCustomers(state, customers) {
            state.customers = customers;
        },
        retrieveSingleCustomer(state, customer) {
            state.customer = customer;
        },
        catchErrors(state, errors) {
            state.errors = errors;
        },
        clearErrors(state) {
            state.errors = {};
        },

        retrieveShipments(state, shipments) {
            state.shipments = shipments;
        },
        retrieveSingleShipment(state, shipment) {

            state.shipment = shipment;
        },
        retrieveShipmentBalanceAmount(state, balance_amount) {

            state.balance_amount = balance_amount;
        },
        retrieveShipmentStatus(state, status) {

            state.shipment_status = status;
        },
        retrieveSingleQuote(state, quote) {

            state.quote = quote;
        },
        retrieveQuotations(state, quotes) {

            state.quotes = quotes;
        },
        retrieveCustomerInvoice(state, invoice) {
            state.customer_invoice = invoice;

        },
        retrieveCustomerQuotes(state, quotes) {
            state.customer_quotes = quotes;

        },
        retrieveDashboardDetails(state, dashboard) {
            state.dashboard = dashboard;

        },
        retrieveStaffs(state, staffs) {
            state.staffs = staffs;


        },
        retrieveSingleStaff(state, staff) {

            state.staff = staff;
        },
    },
    actions: {
        retrieveCustomers(context, page) {

            axios
                .get("/api/customers")
                .then(response => (context.commit('retrieveCustomers', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleCustomer(context, customer_id) {


            axios
                .get("/api/customers/" + customer_id)
                .then(response => (context.commit('retrieveSingleCustomer', response.data.data)))
                .catch(function (error) {
                    // handle error
                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipments(context, page) {
            axios
                .get("/api/shipments?page=" + page)
                .then(response => (context.commit('retrieveShipments', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleShipment(context, invoice_id) {


            axios
                .get(`/api/shipments/${invoice_id}`)
                .then(response => (context.commit('retrieveSingleShipment', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentBalanceAmount(context, invoice_id) {

            axios
                .get("/api/shipments/" + invoice_id + "/balance_amount")
                .then(response => (context.commit('retrieveShipmentBalanceAmount', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveShipmentStatus(context, invoice_id) {

            axios
                .get("/api/shipments/" + invoice_id + "/shipment_status")
                .then(response => (context.commit('retrieveShipmentStatus', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleQuote(context, quote_id) {

            axios
                .get("/api/quotations/" + quote_id)
                .then(response => (context.commit('retrieveSingleQuote', response.data))
                )
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },

        retrieveQuotations(context, page) {
            axios
                .get('/api/quotations?page=' + page)
                .then(response => (context.commit('retrieveQuotations', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerInvoice(context, customer_id) {
            axios
                .get(`/api/customers/${customer_id}/invoices`)
                .then(response => (context.commit('retrieveCustomerInvoice', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveCustomerQuotes(context, customer_id) {
            axios
                .get(`/api/customers/${customer_id}/quotes`)
                .then(response => (context.commit('retrieveCustomerQuotes', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveDashboardDetails(context, customer_id) {
            axios
                .get(`/api/dashboard`)
                .then(response => (context.commit('retrieveDashboardDetails', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveStaffs(context) {
            axios
                .get(`/api/staffs`)
                .then(response => (context.commit('retrieveStaffs', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
        retrieveSingleStaff(context, staff_id) {
            axios
                .get(`/api/staffs/${staff_id}`)
                .then(response => (context.commit('retrieveSingleStaff', response.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        },
    }
})