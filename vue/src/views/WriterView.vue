<template>
  <div class="container">
    <h2 class="m-4"><i>Escritores</i></h2> 
    <div class="row mt-2">
      
      <div class="col-12">
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">Escritor</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody>
            
            <tr v-if="isCreating">
              <td>
                <form @submit.prevent="createWriter">
                  <div class="form-group">
                    
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Nome do escritor" 
                      aria-label="Recipient's username" aria-describedby="button-addon2" ref="writerNameInput">
                      <div class="input-group-append">
                        <button type="submit" class="btn" id="noPadBtn" style="margin-left:2vh;">
                          <i class="bi bi-check2-all checkIcon"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  
                </form>
              </td>
              
              <td>
                <button type="button" id="noPadBtn" class="btn" style="margin: .5vh 0 0 2vh;" 
                @click="cancelCreation()">
                  <i class="bi bi-x-lg xIcon"></i>  
                </button>
              </td>
            </tr>
            <tr v-else>
              <td style=" width:98vh;"><i style="color:gray;">Nome do escritor</i></td>
              <td><button type="button" class="btn" id="noPadBtn" @click="startCreation()">
                <i class="bi bi-person-plus personPlusIcon"></i>
              </button></td>
              
            </tr>
            
            <tr v-for="writer in writers" :key="writer.id" style="height: 6vh">
              <td>
                <span v-if="isEditing === writer.id">
                  <form @submit.prevent="updateWriter(writer)">
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nome do escritor"
                          aria-label="Recipient's username" aria-describedby="button-addon2" ref="writerNameInputUp"
                          v-model="writer.writer_name">
                        <div class="input-group-append">
                          <button type="submit" class="btn" id="noPadBtn" style="margin-left:2vh;">
                            <i class="bi bi-check2-all checkIcon"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </span>
                <span v-else>{{ writer.writer_name }}</span>
              </td>
              <td>
                <span v-if="isEditing === writer.id">
                  <button type="button" class="btn " style="margin: 0.5vh 0px 0px 2vh;" 
                    id="noPadBtn" @click="cancelEditing()">
                    <i class="bi bi-x-lg xIcon"></i>
                  </button>
                </span>
                <span v-else>
                  <button type="button" class="btn" id="noPadBtn" @click="startEditing(writer.id)">
                    <i class="bi bi-pencil-square penIcon"></i>
                  </button>
                  <button type="button" class="btn btn ml-3" id="noPadBtn" style="margin-left:3vh;" 
                    @click="deleteWriter(writer.id)">
                    <i class="bi bi-trash red trashIcon"></i>
                  </button>
                </span>
              </td>
            </tr>
            
            

          </tbody>
        </table>
      </div>
    </div>
    
    <div class="alert alert-danger" v-if="warning">{{ warning }}</div>
    <div class="alert alert-success" v-if="success">{{ success }}</div>

  
  </div>
</template>

<script>
import axios from 'axios'
export default {
  created() {
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
  name: 'WriterView',
  data() {
    return {
      isCreating: false,
      isEditing: false,
      writers: [],
      warning: null,
      success: null,
    };
  },
  methods: {
    startCreation() {
      this.isCreating = true;
    },
    cancelCreation() {
      this.isCreating = false;
    },
    createWriter() {
      const writerName = this.$refs.writerNameInput.value;
      axios.post('http://localhost/api/lib/writer', {
          writer_name: writerName
        }, {
          headers: {
              Authorization: 'Bearer ' + window.localStorage.token 
          },
    })
      .then(() => {
        console.log("Escritor inserido com sucesso")

        this.success = "Escritor inserido com sucesso";       
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

    startEditing(id) {
      this.isEditing = id;
    },
    cancelEditing() {
      this.isEditing = true;
      
      location.reload();
      
    },
    updateWriter(writer) {
      axios.put(`http://localhost/api/lib/writer/${writer.id}`, {
        writer_name: writer.writer_name
      }, {
        headers: {
          Authorization: 'Bearer ' + window.localStorage.token
        }
      })
      .then(() => {
        console.log("Escritor atualizado com sucesso")
        this.success = "Escritor atualizado com sucesso"; 
        setTimeout(() => {
          this.success = null;
        }, 3000);
        this.isEditing = null;
      })
      .catch(error => {

        this.warning = error.response.data.message; 
        setTimeout(() => {
          this.warning = null;
        }, 3000);
        console.log(error);
      });
    },
    deleteWriter(id) {
      fetch('http://localhost/api/lib/writer/'+id, {
        method: 'DELETE',
        headers: {
          Authorization: 'Bearer ' + window.localStorage.token
        }
      })
      .then(response => {
        if (response.ok) {
          console.log("Escritor deletado com sucesso");
          this.isEditing = null;
          setTimeout(() => {
            location.reload();
          }, 800);
          this.success = "Escritor deletado com sucesso"
          
        } else {
          console.error('Erro ao excluir usuário:', response.status);
          
        }
      })
      .catch(error => {
        console.error('Erro ao excluir usuário:', error);
      });
    }

  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
  .red{
    color: #e10303de;
  }
  .remove-border:focus {
    outline: none;
  }
  .trashIcon{
    font-size: 23px;
    transition: .3s;
    
  }
  .trashIcon:hover{
    font-size: 28px;
    transition: .3s;
  }
  .penIcon{
    color: #0d6efd;
    font-size: 22px;
    transition: .3s;
  }
  .penIcon:hover{
    font-size: 27px;
    transition: .3s;
  }
  .xIcon{
    font-size: 17px;
    transition: .3s;
  }
  .xIcon:hover{
    font-size: 23px;
    transition: .3s;
  }
  .checkIcon{
    color: green;
    font-size: 23px;
    transition: .3s;
  }
  .checkIcon:hover{
    font-size: 28px;
    transition: .3s;
  }
  .personPlusIcon{
    font-size: 25px;
    transition: .3s;
  }
  .personPlusIcon:hover{
    font-size: 30px;
    transition: .3s;
  }
  #noPadBtn{
    padding: 0;
  }
  #noPadBtn:active, #noPadBtn:focus {
    border: none !important;
  }

</style>
