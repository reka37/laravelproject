<template>
    <div>
        <form methid="POST" onsubmit="return false;">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" v-model="form.email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" v-model="form.name" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" v-model="form.password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" @click="onRegister" class="btn btn-primary">Submit</button>
        </form>  

    </div>

</template>
<script>
import axios from 'axios';
export default {
        data(){
            return {
                form:{
                    email:null,
                    name:null,
                    password:null
                },
                errors:{}
            };
        },
        methods: {
            onRegister() {
                this.errors = {},
                        axios.post("api/register", this.form).then(response => {
                            if(response.data.success) {
                                localStorage.setItem('token',response.data.remember_token);
                                localStorage.setItem('name',response.data.name);
                                this.$router.push('/');
                            
                            }
               
                        });
            }
        }
}
</script>
