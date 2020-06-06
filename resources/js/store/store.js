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
        shipment: {}
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
            console.log(customer_id);

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
                .get("/api/shipments/" + invoice_id)
                .then(response => (context.commit('retrieveSingleShipment', response.data.data)))
                .catch(function (error) {
                    // handle error

                    context.commit('catchErrors', error.response.data)
                })
        }
    }
})