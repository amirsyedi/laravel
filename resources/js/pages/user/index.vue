<template>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Todo Task</h5>
                        <router-link class="btn btn-primary" :to="{name: 'task'}">Back</router-link>
                        <router-link class="btn btn-primary" :to="{name: 'user-create'}">Create New User</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="users in user" :key="users.id">
                                    <td>{{users.name}}</td>
                                    <td>{{users.email}}</td>
                                    <td>{{users.role}}</td>
                                    <td>
                                        <!-- <button @click="updateStatus" type="submit" class="btn btn-success">Done</button> -->
                                        <router-link class="btn btn-primary" :to="{name: 'user-edit', params: {id: users.id}}">Edit</router-link>
                                        <a @click="deleteUser(users.id)" class="btn btn-danger">Delete</a>
                                    </td>

                                        <!-- <router-link :to="{name:'todos-edit', params: {id: todo.id}}" class="btn btn-primary">Edit</router-link> -->
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
export default {
    data(){
        return{
            user: {}
        }
    },
    methods: {
        getUser(){
            axios.get('/api/index').then((response)=>{
                this.user =response.data
                // console.log(response.data);
            }).catch((errors)=>{
                console.log(errors);
            });
        },
        deleteUser(user_id){
            axios.post('/api/delete/' + user_id).then((response)=>{
                this.getUser()
                console.log(response)
                console.log('User deleted');
            }).catch((errors)=>{
                console.log(errors);
            });
        }
    },
    mounted(){
        this.getUser()
    }

}
</script>

<style>

</style>
