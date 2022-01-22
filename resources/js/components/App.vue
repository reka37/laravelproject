<template>
    <div>
            <router-link to="/head">Главная</router-link>
            <router-link to="/register">Регистрация</router-link>          
            <template v-if="name">
            <button @click="logout">Выход({{name}})</button>
            </template>
            <template v-else>
            <router-link to="/login">Вход</router-link> 
            </template>
            <router-view></router-view>
    </div>
</template>
<script>
import axios from 'axios';
export default {
        data(){
            return {
                    name: localStorage.getItem('name')
  
            };
        },
        methods: {
            logout() {
                this.errors = {},
                        axios.post("api/logout", this.form).then(response => {
                            if(response.data.success) {
                                localStorage.setItem('token','');
                                localStorage.setItem('name','');
                                location.reload();
                            
                            }
               
                        });
            }
        }
}
</script>
