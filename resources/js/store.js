import {
    createStore
} from 'vuex';
import axios from 'axios';

export default createStore({
    state() {
        return {
            userData: {
                user: {},
            }
        };
    },
    mutations: {
        setUser(state, userData) {
            state.userData = userData;
        }
    },
    actions: {
        fetchUser({
            commit
        }) {
            axios.get(route('user'))
                .then(response => {
                    const userData = {
                        user: response.data.user,
                    };
                    commit('setUser', userData);
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }
    },
    getters: {
        getUserData: state => {
            return state.userData;
        }
    }
});
