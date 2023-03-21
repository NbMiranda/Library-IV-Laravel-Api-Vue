<template>
    <div class="container">
      <h2 class="m-4"><i>Livros</i></h2>
    </div>
  </template>
  
  <script>
  export default {
    name: 'BookView',
    mounted() {
    const isLogged = localStorage.isLogged
    if (isLogged != 'true') {
      this.$router.push('/login'); // redireciona para a rota de login
    }
  }
    
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  
  </style>
  