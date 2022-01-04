require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';

import router from './router';

import App from './components/App';

 
Vue.component('headers', require('./components/Headers.vue').default);


Vue.use(VueRouter);
const app = new Vue({
    el:'#app',
    render: h => h(App),
    router
});