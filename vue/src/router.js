import { createRouter, createWebHistory } from 'vue-router';
import TesteView from './components/TesteView.vue';
import HelloWorld from './components/HelloWorld.vue';

const routes = [
  {
    path: '/',
    name: 'HelloWorld',
    component: HelloWorld,
  },
  {
    path: '/teste',
    name: 'TesteView',
    component: TesteView,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
