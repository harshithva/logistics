import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        customers: [],
        errors: []
    },
    getters: {
        getAllCustomers(state) {
            return state.customers
        },
        getAllErrors(state) {
            return state.errors;
        },
        getCustomer(state, id) {
            console.log(id);
            return state.customers.filter(item => item.id === id);
        }
    },
    mutations: {
        retrieveCustomers(state, customers) {
            state.customers = customers;
        },
        catchErrors(state, errors) {
            state.errors = errors;
        }
    },
    actions: {
        retrieveCustomers(context) {

            axios
                .get("/api/customers")
                .then(response => (context.commit('retrieveCustomers', response.data.data)))
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    context.commit('catchErrors', error.response.data)
                })
        },
        createCustomer(context, customer) {

            axios
                .post("/api/customers", customer)
                .then(response => (context.commit('createCustomer', response.data.data)))
                .catch(function (error) {
                    // handle error
                    console.log(error.response.data);
                    context.commit('catchErrors', error.response.data)
                });
        }
    }
})