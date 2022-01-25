<template>
  <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Create New Task</h5>
                      <router-link class="btn btn-primary" :to="{name: 'task'}"> Task List</router-link>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-6 offset-3">
                              <form >
                                <div class="form-group">
                                    <label for="">Task Message</label>
                                    <input type="text" v-model="formData.message" class="form-control" name="message" placeholder="Enter Task">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Upload file</label>
                                    <input type="file" @change="setFiles" class="form-control" id="file_upload" placeholder="Upload file" multiple>
                                </div> -->
                                <div class="form-group">
                                    <button  @click="create1" type="submit" class="btn btn-success">Create Task</button>
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
                message: '',

            }
        }
    },
    methods:{
        create1(){
            axios.post('/api/createTask', this.formData).then((response)=>{
                console.log('Task Created')
                this.$router.push('/task');
            }).catch((errors)=>{
                console.log(errors);
            })
        }
    }
}
</script>

<style>

</style>
