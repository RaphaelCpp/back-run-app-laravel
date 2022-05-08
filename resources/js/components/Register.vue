<template>
    <!-- <router-link :to="'/dashboard'">Dashboard</router-link> -->
    <div class="container divParentForm">
        <form @submit.prevent="login">
            <div class="text-center py-5">
                <h2>Gestion Back Run</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <input
                        type="name"
                        class="mx-auto form-control inputForm"
                        placeholder="marc"
                        v-model="name"
                    />
                </div>
                <div class="col-12 my-3">
                    <input
                        type="email"
                        class="mx-auto form-control inputForm"
                        placeholder="name@example.com"
                        v-model="email"
                    />
                </div>
                <div class="col-12">
                    <input
                        type="password"
                        class="mx-auto form-control inputForm"
                        id="floatingPassword"
                        placeholder="Password"
                        required
                        v-model="password"
                    />
                </div>
                <div class="col-12 my-3">
                    <input
                        type="password"
                        class="mx-auto form-control inputForm"
                        id="floatingPassword2"
                        placeholder="Password confirmation"
                        required
                        v-model="password_confirmation"
                    />
                </div>
            </div>
            <div>
                <p class="text-success text-center">{{ messageOk }}</p>
                <p class="text-danger text-center">{{ messageBad }}</p>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-primary">
                    Inscription
                </button>
            </div>
            <div class="mt-2 text-center mb-5">
                <p>
                    vous avez déjà un compte ? veuillez cliquer
                    <router-link :to="'/'">ici</router-link>
                </p>
            </div>
        </form>
    </div>
</template>

<style>
.divParentForm {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 15px;
    width: 30rem;
    box-shadow: rgb(50 50 93 / 25%) 0px 13px 27px -5px,
        rgb(0 0 0 / 30%) 0px 8px 16px -8px;
}

.inputForm {
    width: 20rem;
}
</style>

<script>
import axios from "axios";
import router from "../router";

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            messageOk: "",
            messageBad: "",
        };
    },
    methods: {
        login() {
            const res = axios
                .post("http://127.0.0.1:8000/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then((result) => {
                    if (result.status === 200) {
                        this.messageOk = result.data?.message;
                        this.messageBad = "";
                        setTimeout(function () {
                            router.push({ path: "/" });
                        }, 1000);
                    }
                })
                .catch((error) => {
                    this.messageOk = "";
                    this.messageBad = "Erreur lors de la création du compte";
                    console.error(error);
                });
        },
    },
};
</script>
