/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from "./views/App";
import VueRouter from "vue-router";
import Vue from "vue";

import Home from "./pages/Home";
import Posts from "./pages/Posts";
import Post from "./pages/Post";
import About from "./pages/About";
import Contacts from "./pages/Contacts";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history', //cambia l'uri del browser
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/posts",
            name: "posts",
            component: Posts
        },
        {
            path: "/posts/:id",
            name: "post",
            props: true,
            component: Post
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/contacts",
            name: "contacts",
            component: Contacts
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
