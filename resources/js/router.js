import VueRouter from 'vue-router';

import Home from './components/Home';
import Login from './components/Login';
import Register from './components/Register';
  
export default new VueRouter ({
        routes:[{
                path:'/',
                component: Home
        },
        {
                path:'/head',
                component: Home
        },
        {
                path:'/register',
                component: Register
        },
        {
                path:'/login',
                component: Login
        }
    ],
    mode:'history'
});