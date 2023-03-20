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
  #app{
    font-family: Arial, sans-serif
  }
  @import '~bootstrap/dist/css/bootstrap.css';
  
  @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");
</style>
