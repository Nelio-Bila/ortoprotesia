<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="admins" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <table
          class="table table-striped table-responsive"
          id="admins_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Nome Completo</th>
              <th>Idade</th>
              <th>Registado aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="admin in admins" :key="admin.id">
              <tr>
                <td>{{ admin.name }} {{ admin.surname }}</td>
                <td>{{ getAge(admin.birthdate) }} anos</td>
                <td>
                  {{ new Date(admin.created_at).toLocaleDateString() }}
                </td>
                <td>
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'admin.details',
                      params: { id: admin.id },
                    }"
                    >Detalhes</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteAdmin(admin.id)"
                  >
                    Eliminar
                  </button>
                </td>
              </tr></template
            >
          </tbody>
        </table>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

import useAdmins from "../../composables/admins";
import HPNavBar from "../../components/HPNavBar.vue";
import HPSideBar from "../../components/HPSideBar.vue";

const { admins, getAdmins, destroyAdmin } = useAdmins();

const getAge = (dateString) => {
  const ageInMilliseconds = new Date() - new Date(dateString);
  return Math.floor(ageInMilliseconds / 1000 / 60 / 60 / 24 / 365); // convert to years
};

onMounted(() => {
  getAdmins();
  setTimeout(() => {
    $("#admins_datatable").DataTable({
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
      pageLength: 5,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/pt-PT.json",
      },
    });
  }, 500);
});

const deleteAdmin = async (id) => {
  new Swal({
    title: "Eliminar este administrador?",
    text: "Tens certeza? Não poderás reverter esta acção!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyAdmin(id);
      getAdmins();
    }
  });
};
</script>
