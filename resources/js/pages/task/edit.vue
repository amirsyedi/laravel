<template>
  <div class="container">

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Edit User</h5>
                      <router-link class="btn btn-primary" :to="{name: 'task'}"> Task List</router-link>

                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-6 offset-3">
                              <form >
                                <div class="form-group">
                                    <label for="">New Task/Message</label>
                                    <input type="text" class="form-control" name="message" placeholder="Enter name" v-model="task.message">
                                </div>
                                <div class="form-group" style="margin 3px;">
                                    <button @click.prevent="taskUpdate" type="submit" class="btn btn-success">Edit Task</button>
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
    data(){
        return{
            task: {}
        }
    },
    methods:{
        getTask(){
            axios.get('/api/editTask/'+ this.$route.params.id).then((response)=>{
                this.task = response.data
                console.log(response.data);
                console.log('task retrieved');
            }).catch((errors)=>{
                console.log(errors);
            })
        },
        taskUpdate(){
            axios.post('/api/updateTask/' + this.$route.params.id,this.task).then((response)=>{
                console.log('Task updated')
                this.$router.push('/task')
            }).catch((errors)=>{
                console.log(errors)
            });
        }
    },
    mounted(){
        this.getTask()
    }
}
</script>

<style>

</style>
