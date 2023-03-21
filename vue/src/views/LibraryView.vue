<template>
  <div class="container">
    <h2 class="m-4"><i>Biblioteca</i></h2>

    <div class="row" style="margin-top:12vh;">
      <div class="col-1"></div>
      <div class="col-5" style="padding: 5vh;">
        <p class="text-center" id="paragraph">
          Seja muito bem-vindo a Biblioteca virtual em sua versão nova e 
          melhorada, faça o <router-link to="/login" id="links">Login</router-link>
          para ter acesso total a biblioteca. <br> <br>
          Aqui na Biblioteca Virtual caso você queira cadastrar um livro ou ver todos os
          livros cadastrados é só ir em 
          <router-link to="/book" id="links">Livros</router-link>, e cadastrar seu livro.
          <br><br>
          De uma olhada na parte dos <router-link to="/writer" id="links">Escritores</router-link> tambem,
          cadastre o escritor do seu livro favorito!

          
      </p>    
      </div>

      <div class="col-1"></div>

      <div class="col-5">
        <img src="../assets/study.png" style="height: 35vh;">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LibraryView',

  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  #links{
    color:#00379a;
    font-weight: 500;
    text-decoration: none;
    transition: .3s;
  }
  #links:hover{
    color:#0148cc;
    border-bottom: 1px solid black;
    font-size: 25px;
    transition: .3s;
    
  }
</style>
