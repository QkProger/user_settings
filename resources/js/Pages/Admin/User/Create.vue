<template>

    <head>
        <title>Добавить пользователя</title>
    </head>
    <AdminLayout>
        <template #breadcrumbs>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Добавить пользователя
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a :href="route('admin.index')">
                                <i class="fas fa-dashboard"></i>
                                Главная страница
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a :href="route('admin.users.index')">
                                <i class="fas fa-dashboard"></i>
                                Пользователи
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Добавить пользователя
                        </li>
                    </ol>
                </div>
            </div>
        </template>
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post" @submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" class="form-control" v-model="user.name" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" class="form-control" v-model="user.phone" name="phone" />
                        </div>
                        <div class="form-group">
                            <label for="">Почта</label>
                            <input type="text" class="form-control" v-model="user.email" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="">Пароль</label>
                            <input type="text" class="form-control" v-model="user.real_password" name="real_password" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-1">
                            Сохранить
                        </button>
                        <button type="button" class="btn btn-danger" @click.prevent="back()">
                            Назад
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
import ValidationError from "../../../Components/ValidationError.vue";

export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        ValidationError,
        Head
    },
    props: [

    ],
    data() {
        return {
            user: {

            },
        }
    },
    created() {
        
    },
    computed: {

    },
    methods: {
        submit() {
            this.$inertia.post(
                route("admin.users.store"),
                this.user,
            );
        },
    },
};
</script>
<style>
.ml33 {
    margin-left: -1rem !important;
    margin-top: -1rem !important;
    margin-right: 1rem;
}
</style>