<template>
 
    <div id="navbar" class="container navbar navbar-expand-lg navbar sticky-top">
        <div class="container-fluid" style="background-color: white;">
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
                        <a v-if="isLogged" @click="logoutRoute()" class="nav-link">Log out</a>
                    </li>
                </ul>
            </div>

            

        </div>
    </div>
  </template>

<script>
    import axios from 'axios'
    let getIsLogged = localStorage.getItem("isLogged")
    export default {
        name: 'NavbarComponent',
        data() {
            return {
            isLogged: getIsLogged,
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
        },
        methods: {
            logoutRoute() {
                axios.post('http://localhost/api/lib/logout', {}, {
                    headers: {
                        Authorization: 'Bearer ' + window.localStorage.token // substitua 'token' pelo seu token real
                    }
                })
                .then(() => {
                // fazer algo em caso de sucesso
                this.$router.push('/login');

                console.log("Deslogado");
                this.isLogged = false

                localStorage.removeItem('isLogged');
                })
                .catch(error => {
                // fazer algo em caso de erro
                    
                console.log(error);
                });
            }
        }


    }

</script>

<style>
    .navbar-toggler{
        border: none !important;
        color: rgba(181, 29, 29, 0.4) !important;
    }
    .navbar-toggler:focus {
        text-decoration: none;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.3) !important;
        border: 1px solid #0000009c !important;
    }
    .nav-link:hover{
        cursor: pointer;
    }   
</style>