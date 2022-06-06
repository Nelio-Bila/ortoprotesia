<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="processes" />

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
            <template v-for="process in processes" :key="process.id">
              <tr>
                <td>{{ process.user.name }} {{ process.user.surname }}</td>
                <td>{{ process.naturality }}</td>
                <td>{{ process.fatherName }} e {{ process.motherName }}</td>
                <td>{{ process.phoneNumber }}</td>
                <td>
                  {{ new Date(process.created_at).toLocaleDateString() }}
                </td>
                <td>
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'process.edit',
                      params: { id: hpro.id },
                    }"
                    >Editar</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteProcess(process.id)"
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

import useProcesses from "../../../composables/processes";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const { processes, getProcesses, destroyProcess } = useProcesses();

onMounted(() => {
  getProcesses();
  setTimeout(() => {
    $("#processes_datatable").DataTable({
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

const deleteProcess = async (id) => {
  new Swal({
    title: "Eliminar este processo?",
    text: "Tens certeza?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyProcess(id);
      getProcesses();
    }
  });
};
</script>
