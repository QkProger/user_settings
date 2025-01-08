<template>
<head>
    <title>Пользователи</title>
</head>
<AdminLayout>
    <template #breadcrumbs>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Список пользователей</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a :href="route('admin.index')">
                            <i class="fas fa-dashboard"></i>
                            Главная страница
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Пользователи
                    </li>
                </ol>
            </div>
        </div>
    </template>
    <template #header>
        <div class="buttons d-flex align-items-center">
            <Link class="btn btn-primary mr-2" :href="route('admin.users.create')">
            <i class="fa fa-plus"></i> Добавить пользователя
            </Link>
            <Link class="btn btn-danger mr-2" :href="route('admin.users.index')">
            <i class="fa fa-trash"></i> Очичить фильтр
            </Link>
        </div>
    </template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr user="row">
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Номер телефона
                                    </th>
                                    <th>Почта</th>
                                    <th>Изменить/Удалить</th>
                                </tr>
                                <tr class="filters">
                                    <td>
                                        <input v-model="filter.id" class="form-control" placeholder='ID' @keyup.enter="search" />
                                    </td>
                                    <td>
                                        <input v-model="filter.name" class="form-control" placeholder='Аты' @keyup.enter="search" />
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd" v-for="(user, index) in users.data" :key="'user' + user.id">
                                    <td>
                                        {{
                                                user.id
                                            }}
                                    </td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <Link :href="route('admin.users.edit', user)" class="btn btn-primary" title="Изменить">
                                            <i class="fas fa-edit"></i>
                                            </Link>
                                            <button @click.prevent="deleteData(user.id)" class="btn btn-danger" title="Удалить">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <Pagination :links="users.links" />
            </div>
        </div>
    </div>
</AdminLayout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
export default {
    components: {
        AdminLayout,
        Link,
        Pagination,
        Head
    },
    props: ["users"],
    data() {
        return {
            filter: {
                id: route().params.id ? route().params.id : null,
                name: route().params.name ? route().params.name : null,
            },
            loading: 0,
        };
    },
    created() {

    },
    computed: {
        
    },
    methods: {
        deleteData(id) {
            Swal.fire({
                title: "Уверены, что хотите удалить?",
                text: "Невозможно будет восстановить",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Да",
                cancelButtonText: "Нет",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route('admin.users.destroy', id))
                }
            });

        },
        search() {
            this.loading = 1
            const params = this.clearParams(this.filter);
            this.$inertia.get(route('admin.users.index'), params)
        },
    }
};
</script>
