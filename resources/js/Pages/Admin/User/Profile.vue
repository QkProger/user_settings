<template>
<head>
    <title>Изменить данные</title>
</head>
<AdminLayout>
    <template #breadcrumbs>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Изменить данные</h1>
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
                        Изменить данные
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
                    <button type="button" class="btn btn-primary mr-1" @click="showConfirmationModal = true, showCodeInput = true">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" @click.prevent="back()">
                        Назад
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div v-if="!is_sended && showConfirmationModal" class="modal" tabindex="-1" role="dialog" style="display:block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Выберите метод подтверждения</h5>
                    <button type="button" class="close" @click="showConfirmationModal = false">
                        <span aria-hidden="true" class="closer">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-info mr-3" @click="sendVerificationCode('email')">Email</button>
                    <button class="btn btn-warning mr-3" @click="sendVerificationCode('sms')">SMS</button>
                    <button class="btn btn-success" @click="sendVerificationCode('tg')">Telegram</button>
                </div>
            </div>
        </div>
    </div>

    <div v-if="is_sended && showCodeInput" class="modal" tabindex="-1" role="dialog" style="display:block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Введите код подтверждения {{ generatedCode }}</h5>
                    <button type="button" class="close" @click="showConfirmationModal = false, showCodeInput = false">
                        <span aria-hidden="true" class="closer">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" v-model="verificationCode" placeholder="Введите код" />
                    <div v-if="timer > 0" class="mt-3">
                        Повторная отправка будет доступна через {{ timer }} секунд.
                    </div>
                    <div v-else class="mt-3 codeAgain" @click="showConfirmationModal = true, is_sended = false">
                        Запросить код снова
                    </div>
                    <button class="btn btn-primary mt-3" @click="verifyCode">Подтвердить</button>
                </div>
            </div>
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
    data() {
        return {
            showConfirmationModal: false,
            showCodeInput: false,
            verificationCode: '',
            generatedCode: null,
            is_sended: false,
            timer: 0,
            countdownInterval: null,
        }
    },
    mounted() {},
    created() {},
    computed: {

    },
    props: [
        'user',
    ],
    beforeUnmount() {
        if (this.countdownInterval) clearInterval(this.countdownInterval);
    },
    methods: {
        async sendVerificationCode(method) {
            this.showConfirmationModal = false;
            const response = await axios.post(route('sendVerificationCode'), {
                method: method,
                user_id: this.user.id,
            });

            this.generatedCode = response.data.code ? response.data.code : null;

            this.showCodeInput = true;
            this.is_sended = true;
            
            this.timer = response.data.timer || 0;
            this.startCountdown();
        },
        async verifyCode() {
            if (!this.verificationCode) {
                alert('Введите код!');
                return;
            }
            const response = await axios.post(route('verify'), {
                code: this.verificationCode,
                user: this.user,
            });

            if (response.data.status == 200) {
                this.resetState();
                alert('Настройка профили успешно изменена!');
            } else {
                this.verificationCode = '';
                this.timer = response.data.timer;
                alert('Неверный код или же он истек!');
            }
        },
        startCountdown() {
            if (this.countdownInterval) clearInterval(this.countdownInterval);
            this.countdownInterval = setInterval(() => {
                if (this.timer > 0) {
                    this.timer--;
                } else {
                    clearInterval(this.countdownInterval);
                }
            }, 1000);
        },
        resetState() {
            this.showConfirmationModal = false;
            this.showCodeInput = false;
            this.verificationCode = '';
            this.timer = 0;
            this.is_sended = false;
            if (this.countdownInterval) clearInterval(this.countdownInterval);
        },
    },
};
</script>

<style lang="scss" scoped>
.ml33 {
    margin-left: -1rem !important;
    margin-top: -1rem !important;
    margin-right: 1rem;
}

.closer {
    font-size: 40px;
    padding-right: 10px;
}
.codeAgain {
    color: blue;
    text-decoration: underline;
    cursor: pointer;
}
</style>
