import axios from 'axios'

export default {
    state: {
        user: null
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },

        clearUserData() {
            localStorage.removeItem('user')
            location.reload()
        }
    },

    actions: {
        login({ commit }, credentials) {
            return axios
                .post('/api/login', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                })
        },

        logout({ commit }) {
            commit('clearUserData')
        }
    },

    getters: {
        isLogged: state => !!state.user,
        getUserData(state) {
            return state.user;
        }
    }
}