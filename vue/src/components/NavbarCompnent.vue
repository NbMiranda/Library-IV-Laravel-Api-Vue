<template>
 
    <div id="navbar" class="container navbar navbar-expand-lg navbar sticky-top">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand" href="#">
                <img src="../assets/open-book.png"
                    alt="Senna" width="45" height="42">
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link" aria-current="page" href="#" v-bind:class="{ active: isHomeRoute }">Biblioteca</router-link>

                    </li>
                    <li class="nav-item">
                        <router-link to="/book" class="nav-link" aria-current="page" href="#" v-bind:class="{ active: isBookRoute }">Livros</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/writer" class="nav-link" aria-current="page" href="#" v-bind:class="{ active: isWriterRoute }">Escritores</router-link>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/login" v-if="!isLogged" class="nav-link">Login</router-link>
                        <router-link to="/logout" v-if="isLogged" class="nav-link">Logout</router-link>
                    </li>
                </ul>
            </div>

            

        </div>
    </div>
  </template>

<script>
    export default {
        name: 'NavbarComponent',
        data() {
            return {
            isLogged: false,
            };
        },
        computed: {
            isHomeRoute() {
            return this.$route.path === '/';
            },
            isBookRoute() {
            return this.$route.path === '/book';
            },
            isWriterRoute() {
            return this.$route.path === '/writer';
            },

        }


    }

</script>

<style>
    
</style>