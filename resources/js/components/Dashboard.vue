<template>
    <div class="container-fluid p-0"><navBar /></div>
    <div class="container-fluid">
        <h2 class="text-center my-5">Gestion utilisateur</h2>
        <table id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.is_admin === 1 ? "True" : "False" }}</td>
                    <td>
                        <a
                            v-bind:data-id="user.id"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            class="editUser btn btn-success btn-sm"
                            >Edit</a
                        >
                        <a
                            v-bind:data-id="user.id"
                            class="delete btn btn-danger btn-sm"
                            >Delete</a
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="userForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading">Edit User</h5>
                        <button
                            type="button"
                            class="close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" />

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label"
                                >Name</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    value="Marc"
                                    name="name"
                                />
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="email" class="col-sm-2 col-form-label"
                                >Email</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="email@example.com"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-sm-2 col-form-label"
                                for="top_duplex_printing"
                                >Admin</label
                            >

                            <div class="col-sm-10 mt-2">
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        id="admin_1"
                                        name="is_admin"
                                        class="form-check-input"
                                        value="1"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="admin_1"
                                        >oui</label
                                    >
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        id="admin_0"
                                        name="is_admin"
                                        class="form-check-input"
                                        value="0"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="admin_0"
                                        >non</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            id="saveBtn"
                            data-bs-dismiss="modal"
                        >
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import axiosClient from "../axios";
import navBar from "./navBar.vue";

export default {
    components: {
        navBar,
    },
    mounted() {
        axiosClient.get("/getAllUser").then((res) => {
            this.users = res.data;
            setTimeout(() => {
                $("#datatable").DataTable({
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"],
                    ],
                    pageLength: 5,
                });
            });
        });

        $("body").on("click", ".editUser", function () {
            var user_id = $(this).data("id");
            console.log(user_id);
            axiosClient.get("users/" + user_id).then((res) => {
                $("#id").val(user_id);
                $("#name").val(res.data.name);
                $("#email").val(res.data.email);
                if (res.data.is_admin === 1) {
                    $("#admin_1").prop("checked", true);
                } else {
                    $("#admin_0").prop("checked", true);
                }
            });
        });

        $("#saveBtn").on("click", function (e) {
            e.preventDefault();
            axiosClient
                .put("users/edit", $("#userForm").serialize())
                .then((res) => {
                    window.location.reload();
                });
        });

        $("body").on("click", ".delete", function () {
            var user_id = $(this).data("id");
            axiosClient.delete("users/delete/" + user_id).then((res) => {
                $(this).closest("tr").remove();
            });
        });
    },
    data: function () {
        return {
            users: [],
        };
    },
};
</script>
