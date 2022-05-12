<template>
  <div>
    <HPNavBar />

    <div class="container-fluid">
      <div class="row">
        <HPSideBar currentLink="categories" />

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <i
            @click="toggleSidebar()"
            class="mt-3 fa-solid fa-bars fa-2xl me-2 text-primary"
          ></i>
          <div
            class="
              d-flex
              justify-content-between
              flex-wrap flex-md-nowrap
              align-items-center
              pt-3
              pb-2
              mb-3
              border-bottom
            "
          >
            <h1 class="h2">Categorias</h1>
          </div>

          <router-link to="/categories/create" class="btn btn-primary mb-2"
            >Nova categoria</router-link
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
                  <td>{{ category.image }}</td>
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
        </main>
      </div>
    </div>
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
