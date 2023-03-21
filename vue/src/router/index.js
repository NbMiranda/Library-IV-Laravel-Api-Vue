import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import LibraryView from '../views/LibraryView.vue'
import WriterView from '../views/WriterView.vue'
import BookView from '../views/BookView.vue'

// import { mapState } from 'vuex'
// import axios from 'axios'


const routes = [
  {
    path: '/',
    name: 'LibraryView',
    component: LibraryView,
    meta: {
      title: 'Biblioteca'
    }
  },
  {
    path: '/login',
    name: 'LoginView',
    component: LoginView,
    meta: {
      title: 'Login'
    }
  },
  {
    path: '/writer',
    name: 'WriterView',
    component: WriterView,
    meta: {
      title: 'Escritores'
    },
    // beforeMount() {
    //   this.getWriters(); // substitua "suaFuncao" pelo nome da sua função
    // }
  },
  
  {
    path: '/book',
    name: 'BookView',
    component: BookView,
    meta: {
      title: 'Livros'
    },
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
})


export default router