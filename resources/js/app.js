import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './router/index.js';
require('./bootstrap');

// window.Vue = require('vue').default;

//  const token= 'Bearer' localStorage.getItem('token');
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const router = new VueRouter

function loggedIn(){
    return localStorage.getItem('token');
}

router.beforeEach((to,from,next)=> {
    if(to.matched.some(record=record.meta.requiresAuth)){
        if(loggedIn){
            next({
                path: '/task',
                query: {redirect: to.fullPath}
            })
        }else {next()}
    }else if (to.matched.some(record=record.meta.guest)){
        if(!loggedIn()){
            next({
                path: '/',
                query: {redirect: to.fullPath}
            })
        }else{ next()}
    }else {next()}
})

const app = new Vue({
    el: '#app',
    router:routes,
});
