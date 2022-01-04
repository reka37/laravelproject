import VueRouter from 'vue-router';

import Home from './components/Home';

export default new VueRouter ({
        routes:[{
                path:'/head',
                component: Home
        }],
    mode:'history'
});