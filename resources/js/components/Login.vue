<template>
    <div class="container">
        <form @submit.prevent="login">
            <div class="text-center py-5">
                <h2>Gestion Back Run</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <input
                        type="email"
                        class="mx-auto form-control"
                        placeholder="name@example.com"
                        v-model="email"
                    />
                </div>
                <div class="col-12 my-3">
                    <input
                        type="password"
                        class="mx-auto form-control"
                        id="floatingPassword"
                        placeholder="Password"
                        required
                        v-model="password"
                    />
                </div>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
            <div class="mt-2 text-center mb-5">
                <p>
                    vous n'avez pas de compte ? veuillez cliquer
                    <a href="">ici</a>
                </p>
            </div>
        </form>
    </div>
</template>

<script>
import store from "../store";
export default {
    data() {
        return {
            email: "",
            password: "",
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
                    store.state.user.token = result.data.access_token;
                    console.log(store.state.user.token);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
