
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import VueAxios from "vue-axios";
import axios from "axios";
import VueRouter from 'vue-router';
axios.defaults.baseURL = "http://localhost:8000/api";
Vue.use(VueAxios, axios);

import Index from './components/Index.vue';
import Posts from './components/Posts.vue';

Vue.use(VueRouter)

require('./bootstrap');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('posts', require('./components/Posts.vue'));
Vue.component('index', require('./components/Index.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));

const router = new VueRouter({
  routes: [
    {
      path: "/",
      name: "Home",
      component: Index
    },
    {
      path: "/posts",
      name: "Bar",
      component: Posts
    }
  ]
})

const app = new Vue({
    el: '#app',
    router
});
