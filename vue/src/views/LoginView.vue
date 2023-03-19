<template>
  <div class="container">
    <h1 class="text-center" style="margin: 7vh;">{{ isLoginActive ? 'Login' : 'Register' }}</h1>

    <div class="row" id="login-group">
      <div class="col-sm-0 col-md-1 col-lg-3"></div>

      <div class="col-md-10 col-sm-12 col-lg-6">
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

        <form autocomplete="off">
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
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginView",
  data() {
    return {
      isLoginActive: true,
      
      
    };
  },
  methods: {
    setActiveButton(button) {
      if (button === "login") {
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

</style>
