import Vue from 'vue';
import VueRouter from 'vue-router';
// import { component } from 'vue/types/umd';

Vue.use(VueRouter);

import Login from '../components/Login.vue';
import Home from '../pages/home.vue';
import User from '../pages/user/index.vue';
import UserCreate from '../pages/user/create.vue';
import UserEdit from '../pages/user/edit.vue';
import Task from '../pages/task/index.vue';
import TaskCreate from '../pages/task/create.vue';
import TaskEdit from '../pages/task/edit.vue';
import { identity } from 'lodash';


const routes = new VueRouter({
    mode: 'history',
    routes: [
    {
        path: '/',
        component: Login,
        name: 'login',
        meta: {
            guest: true
        }
    },
    {
        path: '/home',
        component: Home,
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/user',
        component: User,
        name: 'user',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/user/create',
        component: UserCreate,
        name: 'user-create',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/user/edit/:id',
        component: UserEdit,
        name: 'user-edit',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/task',
        component: Task,
        name: 'task',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/task/create',
        component: TaskCreate,
        name: 'task-create',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/task/edit/:id',
        component: TaskEdit,
        name: 'task-edit',
        meta: {
            requireAuth: true
        }
    },
]
});

export default routes;
