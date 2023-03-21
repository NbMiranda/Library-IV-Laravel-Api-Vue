import { createStore } from 'vuex'
import createPersistedState from "vuex-persistedstate";

const store = createStore({
  state: {
    isLogged: false,
    token: '',
    successMessage: null
  },
  mutations: {
    showSuccessMessage: state => state.successMessage = "Registrado com sucesso",
    logInto: (state, token) => {
        state.isLogged = true;
        state.token = token;
        
        localStorage.setItem("token", token);
        localStorage.setItem("isLogged", true);
      },
  },
  actions: {
    // definir ações
  },
  plugins: [
    createPersistedState({
      path: ['isLogged', 'token']
    })
  ],
  getters: {
    token: (state) => state.token,
    isLogged: (state) => state.isLogged
  },
})

export default store
