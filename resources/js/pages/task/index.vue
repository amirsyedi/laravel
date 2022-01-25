
<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Site Login</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <router-link class="nav-link" :to="{name: 'task'}">Home</router-link>
        </li>
        <li class="nav-item" v-if="user.role === 'admin'">
            <router-link class="nav-link" :to="{name: 'user'}">User</router-link>
        </li>
        <li class="nav-item">
            <a @click.prevent="logout" class="btn btn-danger">Logout</a>
        </li>
        </ul>
        </div>
        </nav>
        <div>
            <h4>Welcome , {{user.role}} {{user.name}}</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Todo Task</h5>
                        <router-link class="btn btn-primary" :to="{name: 'task-create'}">Create New Task</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tasks in task" :key="tasks.id">
                                    <td>{{tasks.id}}</td>
                                    <td>{{tasks.message}}</td>
                                    <td>{{tasks.is_completed}}</td>
                                    <td>
                                        <a @click.prevent="updateStatus(tasks.id)" class="btn btn-success" v-if="tasks.is_completed ==  '0'">Done</a>
                                        <!-- <button @click="updateStatus" type="submit" class="btn btn-success">Done</button> -->
                                        <!-- <router-link :to="{name:'todos-edit', params: {id: todo.id}}" class="btn btn-primary">Edit</router-link> -->
                                        <router-link class="btn btn-primary" :to="{name: 'task-edit', params: {id:tasks.id} }">Edit</router-link>
                                        <a @click.prevent="deleteTask(tasks.id)" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return{
            user: {},
            task: {},
            token: localStorage.getItem('token')
        }
    },
    methods:{
        getData(){
            axios.get('api/getTask/').then((response)=>{
                this.task = response.data
                // console.log(response.data);
            }).catch((errors)=>{
                console.log(errors)
            })
        },
        logout(){
            axios.post('/api/logout').then((response)=>{
                console.log(response);
                localStorage.clear()
                this.$router.push('/')
            })
        },
        deleteTask(task_id){
            axios.post('api/deleteTask/' + task_id).then((response)=>{
                this.getData()
                console.log('Task Delete')
            }).catch((errors)=>{
                console.log(errors)
            })

        },
        updateStatus(task_id){
            axios.post('api/updateStatus/'+ task_id).then((response)=>{
                this.getData()
                console.log('Task Status Updated');
            }).catch((errors)=>{
                console.log(errors);
            })
        }

    },
    mounted(){
        axios.defaults.headers.common["Authorization"] = "Bearer " +this.token
        axios.get('/api/user').then((response)=>{
            console.log(response);
            this.user = response.data
        }).catch((errors)=>{
            console.log(errors);
        });
        this.getData()
    }
}
</script>
<style>

</style>
