<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="health_pros" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <table
          class="table table-striped table-responsive"
          id="hpros_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Nome</th>
              <th>Verificado</th>
              <th>Idade</th>
              <th>Foto</th>
              <th>Carreira</th>
              <th>Categoria</th>
              <th>Instituição</th>
              <th>Departamento</th>
              <th>Inscrito aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="hpro in hpros" :key="hpro.id">
              <tr>
                <td>{{ hpro.name }} {{ hpro.surname }}</td>
                <td class="text-center">
                  <i v-if="hpro.verified" class="fa fa-solid fa-check"></i>
                  <i v-else class="fa fa-solid fa-x"></i>
                </td>
                <td>{{ getAge(hpro.birthdate) }} anos</td>
                <td class="text-center">
                  <img
                    :src="`/images/profile_imgs/` + `${hpro.avatar}`"
                    :alt="`${hpro.name} ${hpro.surname}`"
                    style="height: 30px; width: 30px"
                  />
                </td>
                <td>
                  {{ hpro.carrier }}
                </td>
                <td>
                  {{ hpro.category }}
                </td>
                <td>
                  {{ hpro.institution }}
                </td>
                <td>
                  {{ hpro.department }}
                </td>
                <td>
                  {{ new Date(hpro.created_at).toLocaleDateString() }}
                </td>
                <td class="text-center">
                  <button
                    v-if="!hpro.verified"
                    class="btn btn-sm btn-primary m-1"
                  >
                    Marcar como verificado
                  </button>
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'hpro.details',
                      params: { id: hpro.id },
                    }"
                    >Detalhes</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger m-1"
                    @click="deleteHPro(hpro.id)"
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

const { hpros, getHPros, destroyHpro } = useHPros();
onMounted(() => {
  getHPros();
  setTimeout(() => {
    $("#hpros_datatable").DataTable({
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

const getAge = (dateString) => {
  const ageInMilliseconds = new Date() - new Date(dateString);
  return Math.floor(ageInMilliseconds / 1000 / 60 / 60 / 24 / 365); // convert to years
};

const deleteHpro = async (id) => {
  new Swal({
    title: "Eliminar este profissional de Saúde?",
    text: "Tens certeza? Não poderás reverter esta acção!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyHpro(id);
      getHPros();
    }
  });
};
</script>
