<template>
  <div class="container">
    <h2 class="m-4" ><i>{{ isLoginActive ? 'Login' : 'Register' }}</i></h2>

    <div class="row" id="login-group">
      <div class="col-sm-0 col-md-1 col-lg-3"></div>

      <div class="col-md-10 col-sm-12 col-lg-6 mt-2">
        <button type="button" class="changeOp mb-4" 
          :class="{ 'active': isLoginActive }"
          @click="setActiveButton('login')">
          Login
        </button>
        
        <button type="button" class="changeOp mb-4"
          :class="{ 'active': !isLoginActive }"
          @click="setActiveButton('register')">
          Register
        </button>

        <form autocomplete="off" @submit.prevent="submitForm">

          <!-- Name -->
          <div class="mb-3">
            <label for="nameInput" class="form-label" v-if="!isLoginActive">Nome</label>
            <input v-if="!isLoginActive" type="text" name="name"
              class="form-control" id="nameInput"
              placeholder="Seu Nome Completo"/>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" name="email"
              id="exampleInputEmail1" aria-describedby="emailHelp"
              :placeholder="isLoginActive ? 'Email' : 'Digite seu melhor Email'"/>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input ref="passwordInput" type="password" class="form-control" id="exampleInputPassword1"
              placeholder="Digite sua senha" name="password" v-model="password1"/>
          </div>

          <!-- Forgot Password -->
          <router-link v-if="isLoginActive" to="/" class="nav-link tes mt-4 mb-3">Esqueceu sua senha?</router-link>

          <!-- Confirm Password -->
          <div v-if="!isLoginActive" class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirme a senha</label>
            <input ref="passwordInput2" type="password" class="form-control" id="exampleInputPassword2"
            placeholder="Confirme sua senha" v-model="password2"/>
          </div>

          <!-- Show Password -->
          <div v-if="!isLoginActive" class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="showPassword" @click="togglePasswordVisibility()"/>

            <label class="form-check-label" for="showPassword">Mostrar senha</label>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn btn-dark mt-3">
            {{ isLoginActive ? 'Logar' : 'Registrar' }}
          </button>
        </form>
      </div>

      <div class="sol-sm-0 col-md-1 col-lg-3"></div>

      <!-- Exibição da mensagem de erro -->
      <div v-show="errorMessage" class="alert alert-danger" role="alert">
        {{ errorMessage }}
      </div>

      <!-- Exibição da mensagem de sucesso -->
      <div v-show="successMessage" class="alert alert-success" role="alert">
        {{ successMessage }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapState, mapMutations } from 'vuex'

export default {
  name: "LoginView",
  computed:{
    ...mapState({
        successMessage: state => state.successMessage
      })
  },
  data() {
    return {
      isLoginActive: true,
      errorMessage: '',
      
    };
  },

  methods: {
    passwordsMatch() {
      return this.password1 === this.password2;
    },
    submitForm() {
      if (!this.passwordsMatch() && !this.isLoginActive ) {
        this.errorMessage = 'As senhas não correspondem.';
        return;
      }
      const endpoint = this.isLoginActive ? "http://localhost/api/login" : "http://localhost/api/register";
      axios.post(endpoint, new FormData(event.target))
        .then((response) => {
          if (this.isLoginActive) {
            // this.$router.push('/');
            this.$router
            .push({ path: '/' })
            .then(() => { this.$router.go() })

            this.$store.commit('logInto', response.data.token);
            
          } 
          else {
            this.showSuccessMessage();
            this.isLoginActive = true
            this.hidePassword()
            // location.reload();
            
          }
          location.reload();
          console.log(response)
          
        })
        .catch((error) => {
          console.error(error.response.data.message);
          this.errorMessage = error.response.data.message;
          this.clearErrorMessageAfterDelay(5000);
        });
    },
    ...mapMutations([
      'showSuccessMessage'
    ]),

    // Método para alternar entre login e registro
    toggleLogin() {
      this.isLoginActive = !this.isLoginActive;
    },

    // Método para validar campos de entrada
    validateFields() {
      // Realizar validação dos campos de entrada aqui
    },

    setActiveButton(button) {
      if (button === "login") {
        location.reload()
        this.isLoginActive = true;
      } else if (button === "register") {
        this.isLoginActive = false;
      }
    },

    showPassword() {
      this.$refs.passwordInput.type = 'text';
      this.$refs.passwordInput2.type = 'text';
    },
    hidePassword() {
      this.$refs.passwordInput.type = 'password';
      this.$refs.passwordInput2.type = 'password';
    },

    togglePasswordVisibility() {
      if (this.show) {
        this.hidePassword();
      } else {
        this.showPassword();
      }
      this.show = !this.show;
    },
    clearErrorMessageAfterDelay(delay) {
      setTimeout(() => {
        this.errorMessage = '';
      }, delay);
    },

  },
};
</script>

<style>
.changeOp {
  margin: 0;
  padding: 0;
  border: none;
  margin-right: 1.4em;

  border-radius: 0;
  background-color: white;
}
.active {
  border-bottom: 1px solid black;
}

input::placeholder {
  font-size: 15px;
}

.form-control:focus, .form-select:focus {
    border-color: black !important;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.2) !important;

}

.form-check-input:enabled {
    border-color: black !important;
    box-shadow: none;
}

.form-check-input:checked{
  background-color: black;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.2) !important;

}

.alert{
    width: 33vh;
    position: fixed;
    bottom: 5vh;
    right: 1vh;
    width: 33vh;
    position: fixed;
    bottom: 5vh;
    right: 1vh;
  }
.alert-danger {
  color: black;
  background-color: #fc6060da;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.10) !important;
}
.alert-success {
  color: black;
  background-color: #89ff9def;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.10) !important;
}
</style>
