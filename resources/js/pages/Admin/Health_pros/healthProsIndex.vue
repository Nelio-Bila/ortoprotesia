<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="health_pros" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <router-link to="/categories/create" class="btn btn-primary mb-2"
          >Registar profissional de Saúde</router-link
        >

        <table
          class="table table-striped table-responsive"
          id="hpros_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Nome</th>
              <th>Data de nascimento</th>
              <th>Foto</th>
              <th>Carreira</th>
              <th>Categoria</th>
              <th>Instituição</th>
              <th>Departamento</th>
              <th>Data de inicio de funções</th>
              <th>Verificado aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="hpro in hpros" :key="hpro.id">
              <tr>
                <td>{{ hpro.name }} {{ hpro.surname }}</td>
                <td>
                  {{ new Date(category.birthdate).toLocaleDateString() }}
                </td>
                <td class="text-center">
                  <img
                    :src="'images/icons/' + hpro.avatar"
                    :alt="`${hpro.name} ${hpro.surname}`"
                    style="height: 30px; width: 30px"
                  />
                </td>
                <td>
                  {{ category.carrier }}
                </td>
                <td>
                  {{ category.category }}
                </td>
                <td>
                  {{ category.institution }}
                </td>
                <td>
                  {{ category.department }}
                </td>
                <td>
                  {{ category.startingWorkDate }}
                </td>
                <td>
                  {{ new Date(category.created_at).toLocaleDateString() }}
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

<script>
import { onMounted } from "vue";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

import useHPros from "../../../composables/hpros";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

export default {
  components: {
    HPNavBar,
    HPSideBar,
  },
  setup() {
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
      }, 250);
    });

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
    return {
      hpros,
      deleteHpro,
    };
  },
};
</script>
