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
          >Novo profissional de Saúde</router-link
        >

        <table
          class="table table-striped table-responsive"
          id="categories_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Nome</th>
              <th>Imagem</th>
              <th>Criada aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="category in categories" :key="category.id">
              <tr>
                <td>{{ category.name }}</td>
                <td class="text-center">
                  <img
                    :src="'images/icons/' + category.image"
                    alt="categoria"
                    style="height: 30px; width: 30px"
                  />
                </td>
                <td>
                  {{ new Date(category.created_at).toLocaleDateString() }}
                </td>
                <td>
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'categories.edit',
                      params: { id: category.id },
                    }"
                    >Editar</router-link
                  >
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteCategory(category.id)"
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

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

export default {
  components: {
    HPNavBar,
    HPSideBar,
  },
  setup() {
    const { categories, getCategories, destroyCategory } = useCategories();
    onMounted(() => {
      getCategories();
      setTimeout(() => {
        $("#categories_datatable").DataTable({
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

    const deleteCategory = async (id) => {
      new Swal({
        title: "Eliminar esta categoria?",
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
    return {
      categories,
      deleteCategory,
    };
  },
};
</script>
