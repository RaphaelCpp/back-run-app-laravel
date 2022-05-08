<script>
import axiosClient from "../axios";
import { onMounted, ref } from "vue";
export default {
    data() {
        return {
            users: [],
        };
    },
    methods: {
        loadData() {
            axiosClient.post("/profile").then((result) => {
                this.users = result?.data;
            });
        },
        logout: function () {
            this.$router.push("/");
            localStorage.removeItem("auth_token");
        },
    },
    // setup() {
    //     onMounted(() => {
    //         axiosClient.post("/profile").then((result) => {
    //             console.log(result.data);
    //             this.users = result.data;
    //         });
    //     });
    // },
    created() {
        this.loadData();
    },
};
</script>
<template>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand ms-5" href="#">RUN APP</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <router-link class="nav-item nav-link" :to="'/dashboard'"
                    >Gestion utilisateur</router-link
                >

                <router-link class="nav-item nav-link" :to="'/userrun'"
                    >Gestion des courses</router-link
                >
            </div>
            <div class="usermail">
                <span class="pe-1">{{ users?.email }}</span>
                <a v-on:click="logout" href=""
                    ><img
                        src="../../../public/images/logout.png"
                        width="18"
                        height="18"
                /></a>
            </div>
        </div>
    </nav>
</template>

<style>
.usermail {
    position: absolute;
    right: 3px;
}
</style>
