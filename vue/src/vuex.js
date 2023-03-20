import { createStore } from 'vuex'

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
      },
  },
  actions: {
    // definir ações
  },
  getters: {
    // definir getters
  }
})

export default store
