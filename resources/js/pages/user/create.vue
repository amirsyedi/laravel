<template>
  <div class="container">

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Create New User</h5>
                      <router-link class="btn btn-primary" :to="{name: 'user'}"> User List</router-link>

                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-6 offset-3">
                              <form >
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" v-model="formData.name" class="form-control" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" v-model="formData.email" class="form-control" name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" v-model="formData.password" class="form-control" name="password" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label for="">Password Confirmation</label>
                                    <input type="password" v-model="formData.password_confirmation" class="form-control" name="password_confirmation" placeholder="Re-enter password">
                                </div>
                                <div>
                                    <button @click.prevent="create" type="submit" class="btn btn-success">Create User</button>
                                </div>
                            </form>
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
    data (){
        return{
            formData:{
                name: '',
                email: '',
                password: '',
                password_confirmation:''
            }
        }
    },
    methods:{
        create(){
            axios.post('/api/register', this.formData).then((response)=>{
                console.log('User Created')
                this.$router.push('/user');
            }).catch((errors)=>{
                console.log(errors);
            })
        }
    }
}
</script>

<style>

</style>
