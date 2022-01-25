<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="container">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" v-model="formData.email">
                        </div>
                        <div class="container">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" v-model="formData.password">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="container">
                                    <button  @click="login" type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            formData:{
                email: '',
                password: '',
                device_name: 'userToken'
            },
            error: {}
        }
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie').then((response)=>{
            axios.post('api/login',this.formData).then((response)=>{
                console.log('Logged in')
                localStorage.setItem('token', response.data.token)
                this.$router.push('/task')
            }).catch((error)=>{
                this.errors = errors.response.data.errors
            })
            })
        }
    },
    mounted(){
        axios.defaults.headers.common["Authorization"] = "Bearer " + this.token
    }
}
</script>

<style>

</style>
