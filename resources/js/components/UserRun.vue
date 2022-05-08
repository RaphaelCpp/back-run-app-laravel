<template>
    <div class="container-fluid p-0"><navBar /></div>
    <div class="container-fluid">
        <h2 class="text-center my-5">Gestion des courses</h2>
        <table id="datatable" style="table-layout: fixed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>lat long</th>
                    <th>time</th>
                    <th>km</th>
                    <th>created</th>
                    <th>user id</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="run in runs" :key="run.id">
                    <td>{{ run.id }}</td>
                    <td style="word-wrap: break-word">{{ run.lat_long }}</td>
                    <td>{{ run.time }}</td>
                    <td>{{ run.km }}</td>
                    <td>{{ run.created_at.slice(0, 10) }}</td>
                    <td>{{ run.user_id }}</td>
                    <td>
                        <a
                            v-bind:data-id="run.id"
                            class="deleteRun btn btn-danger btn-sm"
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
                        <h5 class="modal-title" id="modelHeading">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="name" name="name" />
                        <input type="text" id="email" name="email" />
                        <input type="text" id="admin" name="is_admin" />
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            id="saveBtn"
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
        axiosClient.get("/getAllRun").then((res) => {
            this.runs = res.data;
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

        $("body").on("click", ".edit", function () {
            var run_id = $(this).data("id");
            console.log(run_id);
            //$.get("{{ url('users')}}" + "/" + user_id, function (data) {
            //     $("#modelHeading").html("Edit User");
            //     $("#saveBtn").val("edit-user");
            //     $("#user_id").val(data.id);
            //     $("#name").val(data.name);
            //     $("#email").val(data.email);
            // });
        });

        $("body").on("click", ".deleteRun", function () {
            //alert("lol");
            var run_id = $(this).data("id");
            axiosClient.delete("run/delete/" + run_id).then((res) => {
                $(this).closest("tr").remove();
            });
        });
    },
    data: function () {
        return {
            runs: [],
        };
    },
};
</script>
