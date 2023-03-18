<template>
  <div>
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <LoginComponent/>
  </div>
</template>

<script>
import LoginComponent from './components/LoginComponent.vue'

export default {
  name: 'App',
  components: {
    LoginComponent
  }
}
</script>

<style>
  @import '~bootstrap/dist/css/bootstrap.css';
</style>
