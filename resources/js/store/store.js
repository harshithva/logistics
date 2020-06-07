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
        shipment_status: {}
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
            console.log(status);

            state.shipment_status = status;
        },
    },
    actions: {
        retrieveCustomers(context) {

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
        retrieveShipments(context) {
            axios
                .get("/api/shipments")
                .then(response => (context.commit('retrieveShipments', response.data.data)))
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
        }
    }
})