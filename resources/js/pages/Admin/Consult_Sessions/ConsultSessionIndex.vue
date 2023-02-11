<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="categories" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <router-link to="/consultsessions/create" class="btn btn-primary mb-2"
          >Nova Sessão de consultas</router-link
        >

        <table
          class="table table-striped table-responsive"
          id="consultsessions_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Tipo</th>
              <th>Data prevista</th>
              <th>Realizada</th>
              <th>Activa</th>
              <th>Criada aos</th>
              <th v-if="useUser?.user?.is_admin">Acções</th>
            </tr>
          </thead>
          <tbody>
            <template
              v-for="consultSession in consultSessions"
              :key="consultSession.id"
            >
              <tr>
                <td>{{ consultSession.type }}</td>
                <td>{{ consultSession.date }}</td>
                <td>{{ consultSession.accomplished }}</td>
                <td class="text-center">
                  <i
                    class="fa-sharp fa-solid fa-check"
                    v-if="!consultSession.deleted_at"
                  ></i>
                  <i class="fa-sharp fa-solid fa-xmark" v-else></i>
                </td>
                <td>
                  {{ new Date(consultSession.created_at).toLocaleDateString() }}
                </td>
                <td v-if="useUser?.user?.is_admin">
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'categories.edit',
                      params: { id: consultSession.id },
                    }"
                    >Editar</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteConsultSession(consultSession.id)"
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

  <script>
import { onMounted } from "vue";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
// import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

import { useUserStore } from "../../../stores/UserStore";
import useConsultSessions from "../../../composables/consultSessions";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

export default {
  components: {
    HPNavBar,
    HPSideBar,
  },
  setup() {
    const { consultSessions, getConsultSessions, deleteConsultSession } =
      useConsultSessions();
    const useUser = useUserStore();

    onMounted(() => {
      getConsultSessions();
      setTimeout(() => {
        $("#consultsessions_datatable").DataTable({
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

    const destroyConsultSession = async (id) => {
      new Swal({
        title: "Eliminar este registro?",
        text: "Tens certeza? Não poderás reverter esta acção!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#902f37",
        confirmButtonText: "Sim, Eliminar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          deleteConsultSession(id);
          getConsultSessions();
        }
      });
    };
    return {
      consultSessions,
      deleteConsultSession,
      useUser,
    };
  },
};
</script>
