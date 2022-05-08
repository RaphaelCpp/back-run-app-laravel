<template>
    <div class="container divParentForm">
        <form @submit.prevent="login">
            <div class="text-center py-5">
                <h2>Gestion Back Run</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <input
                        type="email"
                        class="mx-auto form-control inputForm"
                        placeholder="name@example.com"
                        v-model="email"
                    />
                </div>
                <div class="col-12 my-3">
                    <input
                        type="password"
                        class="mx-auto form-control inputForm"
                        id="floatingPassword"
                        placeholder="Password"
                        required
                        v-model="password"
                    />
                </div>
            </div>
            <div>
                <p class="text-danger text-center">{{ message }}</p>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>

            <div class="mt-2 text-center mb-5">
                <p>
                    vous n'avez pas de compte ? veuillez cliquer
                    <router-link :to="'/register'">ici</router-link>
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
import store from "../store";
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
            message: "",
        };
    },
    methods: {
        login() {
            const res = axios
                .post("http://127.0.0.1:8000/api/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((result) => {
                    if (result.data.user_admin === 1) {
                        this.message = "";
                        localStorage.setItem(
                            "auth_token",
                            result.data.access_token
                        );
                        store.state.user.token = result.data.access_token;
                        this.$router.push("/dashboard");
                    } else {
                        this.message =
                            "Vous devez être admin pour vous connecter !";
                    }
                })
                .catch((error) => {
                    this.message = "informations incorrectes !";
                    console.error(error);
                });
        },
    },
};
</script>
