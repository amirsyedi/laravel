<template>
  <div class="container">

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Edit User</h5>
                      <router-link class="btn btn-primary" :to="{name: 'user'}"> User List</router-link>

                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-6 offset-3">
                              <form >
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" v-model="user.name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text"  class="form-control" name="email" placeholder="Enter email" v-model="user.email">
                                </div>
                                <div class="form-group" style="margin 3px;">
                                    <button @click.prevent="update" type="submit" class="btn btn-success">Edit User</button>
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
    mounted(){
        this.getUser()
    },
    data(){
        return{
            user: {}
        }
    },
    methods: {
        getUser(){
            axios.get('/api/edit/' + this.$route.params.id).then((response)=>{
                this.user = response.data
                console.log(response.data);
                console.log('User data retrieved');
            }).catch((errors)=>{
                console.log(errors)
            });
        },
        update(){
            axios.post('/api/update/' + this.$route.params.id,this.user).then((response)=>{
                console.log('User updated')
                this.$router.push('/user')
            }).catch((errors)=>{
                console.log(errors)
            });
        }
    },
    mounted(){
        this.task
    }
}
</script>

<style>

</style>
