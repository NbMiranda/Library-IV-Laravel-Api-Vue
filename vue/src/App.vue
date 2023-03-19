<template>
  <NavbarComponent />
  <router-view/>
</template>

<script>
import NavbarComponent from './components/NavbarCompnent.vue';


export default {
  components: {
    NavbarComponent
  }
}

</script>

<style>
  @import '~bootstrap/dist/css/bootstrap.css';
</style>
