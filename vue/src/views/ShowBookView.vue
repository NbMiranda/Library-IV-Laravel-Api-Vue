<template>
    <div class="container">
        <h2 class="m-4"><i>Edite o Livro <b>{{ book.book_name }}</b></i></h2>
        
        <form class="mt-5" @submit.prevent="updateWriter">
            <div class="row">
              <div class="col-6">
                <label for="book_name" class="form-label">Nome do Livro</label>
                <input type="text" class="form-control" id="book_name" 
                  placeholder="Digite o nome do livro" ref="bookNameInput" :value="book.book_name">
              </div>
    
              <div class="col-6">
                <label for="writer_name" class="form-label">Nome do escritor</label>
                <select class="form-select" aria-label="Default select example" 
                id="writer_name" ref="writerNameSelect">
                  <option value="">Escolha o escritor</option>
                  <option v-for="writer in writers" :key="writer.id" :value="writer.id" :selected="writer.id == book.writer_id">
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
                    <option value="">Escolha o gênero</option>
                    <option v-for="(option, index) in options" :key="index" 
                     :value="option" :selected="book.genre == option">
                        {{ option }}
                    </option>
                  
                  
                </select>
              </div>
              
    
              <div class="col-6">
                <label for="other_genres" class="form-label">Outros gêneros (Opcional)</label>
                <input type="text" class="form-control" id="other_genres" 
                placeholder="Digite os gêneros" ref="genreInput" :value="book.other_genre">
              </div>
            </div>
            
            <div class="col-12 mt-5">
                
                <label for="synopsis">Sinopse</label>
                <textarea class="form-control mt-2" style="height:30vh;" 
                 v-model="book_synopsis" id="synopsis" ref="synopsisInput">
                </textarea>
                    
                
            </div>
            <button type="submit" class="btn btn-dark mt-4">Salvar</button>
          </form>
        
      
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
    name: 'ShowBookView',
    props: ['id'],
    created() {
      axios.get('http://localhost/api/lib/book/' + this.id, {
        headers: {
          'Authorization': 'Bearer ' + window.localStorage.token 
        }
      })
      .then(response => {
        this.book = response.data
        this.book_synopsis = response.data.synopsis
        
        console.log(response.data)
      })
      .catch(error => {
        
        console.log(error)
       })
       ,
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
        options: [
          'Ação e Aventura', 'Terror', 'Fantasia', 'Romance', 'Infantil', 'Terror', 'Mistico', 'Religioso',
          'Biografia', 'Culinaria', 'Escolar', 
        ],
        book: [],
        writers: [],
        book_synopsis: ''
      };
    },
    // this.$router.push('/login');
    methods: { 
        updateWriter() {
            const bookName = this.$refs.bookNameInput.value;
            const writerName = this.$refs.writerNameSelect.value;
            const genre = this.$refs.genreSelect.value;
            const otherGenre = this.$refs.genreInput.value;
            const synopsis = this.$refs.synopsisInput.value;
            axios.put('http://localhost/api/lib/book/' + this.id, {
                book_name: bookName,
                writer_id: writerName,
                genre: genre,
                other_genre: otherGenre,
                synopsis: synopsis,
            }, {
                headers: {
                Authorization: 'Bearer ' + window.localStorage.token
                }
            })
            .then(() => {
                console.log("livro atualizado com sucesso")
                this.$router.push('/book');
            })
            .catch(error => {
                console.log(error);
                this.$router.push('/book');
            });
        }
    }
    
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style>

  </style>
  