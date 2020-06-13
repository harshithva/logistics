import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'


import auth from './modules/auth'
import admin from './modules/admin'


Vue.use(Vuex)

export const store = new Vuex.Store({
    modules: {
        auth,
        admin
    }
})