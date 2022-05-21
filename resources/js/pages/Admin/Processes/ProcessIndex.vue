<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="users" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <table
          class="table table-striped table-responsive"
          id="users_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Nome do utente</th>
              <th>Naturalidade</th>
              <th>Filiação</th>
              <th>Contacto</th>
              <th>Registado aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="hpro in hpros" :key="hpro.id">
              <tr>
                <td>{{ hpro.name }} {{ hpro.surname }}</td>
                <td>{{ hpro.naturality }}</td>
                <td>{{ hpro.fatherName }} e {{ hpro.motherName }}</td>
                <td>{{ hpro.phoneNumber }}</td>
                <td>
                  {{ new Date(hpro.created_at).toLocaleDateString() }}
                </td>
                <td>
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'hpros.edit',
                      params: { id: hpro.id },
                    }"
                    >Editar</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteUser(hpro.id)"
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

import useHPros from "../../../composables/hpros";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const { hpros, getHPros, destroyHPro } = useHPros();

onMounted(() => {
  getUsers();
  setTimeout(() => {
    $("#users_datatable").DataTable({
      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
      pageLength: 5,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/pt-PT.json",
      },
    });
  }, 250);
});

const deleteUser = async (id) => {
  new Swal({
    title: "Eliminar este profissional?",
    text: "Tens certeza? Não poderás reverter esta acção!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyCategory(id);
      getCategories();
    }
  });
};
</script>
