<template>
    <div class="container">
      <h2 class="m-4"><i>Livros</i></h2>
       
      <!-- Register Form -->
      <button type="button" class="btn btn-dark" @click="toggleForm">
        {{ showForm ? 'Ocultar Form' : 'Mostrar Form' }}
      </button>
      <form class="mt-5" v-show="showForm" @submit.prevent="createBook">

        <div class="row">
          <div class="col-6">
            <label for="book_name" class="form-label">Nome do Livro</label>
            <input type="text" class="form-control" id="book_name" 
              placeholder="Digite o nome do livro" ref="bookNameInput">
          </div>

          <div class="col-6">
            <label for="writer_name" class="form-label">Nome do escritor</label>
            <select class="form-select" aria-label="Default select example" 
            id="writer_name" ref="writerNameSelect">
              <option selected value="">Escolha o escritor</option>
              <option v-for="writer in writers" :key="writer.id" :value="writer.id">
                {{ writer.writer_name }}
              </option>
              
            </select>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6">
            <label for="genre" class="form-label">Genêro principal</label>
            <select class="form-select" aria-label="Default select example"
             id="genre" ref="genreSelect">
              <option selected value="">Escolha o gênero</option>
              <option v-for="(option, index) in options" :key="index" :value="option">{{ option }}</option>
              
              
            </select>
          </div>

          <div class="col-6">
            <label for="other_genres" class="form-label">Outros gêneros (Opcional)</label>
            <input type="text" class="form-control" id="other_genres" 
            placeholder="Digite os gêneros" ref="genreInput">
          </div>
        </div>

        <button type="submit" class="btn btn-dark mt-4">Salvar</button>
      </form>

      <!-- Show the registers -->

      <h5 class="mt-5 mb-4"><i>Livros Registrados</i></h5>

      <table class="table">
        <thead class="table-dark">
          <tr>
            
            <th scope="col">Livro</th>
            <th scope="col">Escritor</th>
            <th scope="col">Gênero</th>
            <th scope="col">Editar</th>
            <th scope="col">Deletar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book in books" :key="book.id">
            
            <td>{{ book.book_name }}</td>
            <td>{{ book.writer.writer_name }}</td>
            <td>{{ book.genre }}</td>
            <td>
              <router-link :to="`/show-book/${book.id}`" class="btn" id="noPadBtn" style="margin-left:1.5vh;">
                <i class="bi bi-pencil-square penIcon"></i>
              </router-link>

            </td>
            <td>
              <button type="button" class="btn btn ml-3" id="noPadBtn" 
              style="margin-left:1.5vh;" @click="deleteBook(book.id)">
              <i class="bi bi-trash red trashIcon"></i>
            </button>
            </td>
          </tr>
        </tbody>
      </table>


      <!-- Messages -->
      <div class="alert alert-danger" v-if="warning">{{ warning }}</div>
      <div class="alert alert-success" v-if="success">{{ success }}</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
    name: 'BookView',
    mounted() {
      const isLogged = localStorage.isLogged
      if (isLogged != 'true') {
        this.$router.push('/login'); // redireciona para a rota de login
      }
    },
    created() {
      axios.get('http://localhost/api/lib/book', {
        headers: {
          'Authorization': 'Bearer ' + window.localStorage.token 
        }
      })
      .then(response => {
        this.books = response.data
        
        console.log(response.data)
      })
      .catch(error => {
        
        console.log(error)
      }),
      axios.get('http://localhost/api/lib/writer', {
        headers: {
          'Authorization': 'Bearer ' + window.localStorage.token 
        }
      })
      .then(response => {
        this.writers = response.data
        
        console.log(response.data)
      })
      .catch(error => {
        
        console.log(error)
      })
    },
    data() {
      return {
        showForm: false,
        options: [
          'Ação e Aventura', 'Terror', 'Fantasia', 'Romance', 'Infantil', 'Terror', 'Mistico', 'Religioso',
          'Biografia', 'Culinaria', 'Escolar', 
        ],
        warning: null,
        success: null,
        books: [],
        writers: [],
      };
    },
    methods: {
      toggleForm() {
        this.showForm = !this.showForm;
      },
      createBook() {
      const bookName = this.$refs.bookNameInput.value;
      const writerName = this.$refs.writerNameSelect.value;
      const genre = this.$refs.genreSelect.value;
      const otherGenre = this.$refs.genreInput.value;
      axios.post('http://localhost/api/lib/book', {
          book_name: bookName,
          writer_id: writerName,
          genre: genre,
          other_genre: otherGenre,
        }, {
          headers: {
              Authorization: 'Bearer ' + window.localStorage.token 
          },
    })
      .then(() => {
        console.log("Livro inserido com sucesso")

        this.success = "Livro inserido com sucesso";       
        setTimeout(() => {
          location.reload();
        }, 800);
      })
      .catch(error => {
        this.warning = error.response.data.message; 
        setTimeout(() => {
          this.warning = null;
        }, 3000);           
        console.log(error);
        
      });
    },
    deleteBook(id) {
      fetch('http://localhost/api/lib/book/'+id, {
        method: 'DELETE',
        headers: {
          Authorization: 'Bearer ' + window.localStorage.token
        }
      })
      .then(response => {
        if (response.ok) {
          console.log("Livro deletado com sucesso");
          setTimeout(() => {
            location.reload();
          }, 800);
          this.success = "Livro deletado com sucesso"
          
        } else {
          console.error('Erro ao excluir Livro:', response.status);
          
        }
      })
      .catch(error => {
        console.error('Erro ao excluir livro:', error);
      });
    }
    }

    
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  
  </style>
  