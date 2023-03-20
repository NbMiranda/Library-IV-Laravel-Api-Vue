<template>
    <div class="container">
      <h2 class="m-4"><i>Escritores</i></h2> 
      <div class="row mt-2">
        
        <div class="col-12">
          <table class="table">
            <thead class="table-dark">
              <tr>
                
                <th scope="col">Nome do Escritor</th>
                <th scope="col">Ação</th>
                <th scope="col">Deletar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                
                <td>Mark</td>
                <td>Otto</td>
                <td><button type="button" class="btn"><i class="bi bi-trash" style="font-size:20px; color:#d70a0aeb;"></i></button></td>
              </tr>
              <tr>
               
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
              
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'WriterView',
    data() {
    return {
      isCreating: false,
      
    };
  },
    
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  
  </style>
  