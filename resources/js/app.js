require('./bootstrap');

import Vue from 'vue';

Vue.component('headers', require('./components/Headers.vue').default);



const app = new Vue({
    el:'#app'
});