import { createApp } from 'vue';
import VueAwesomePaginate from "vue-awesome-paginate";
import "vue-awesome-paginate/dist/style.css";
import { createRouter, createWebHistory } from 'vue-router'
import PropertyList from "./components/PropertyList.vue";
import App from './components/App.vue';

const routes = [
    { path: "/", component: PropertyList },
    { path: "/:province", component: PropertyList }
  ];
 
const router = createRouter({ 
    history: createWebHistory(),
    routes
})


createApp(App).use(router).use(VueAwesomePaginate).mount('#app')