<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="categories" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
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
              <th>Activa</th>
              <th>Criada aos</th>
              <th v-if="useUser?.user?.is_admin">Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="category in categories" :key="category.id">
              <tr>
                <td>{{ category.name }}</td>
                <td class="text-center">
                  <i
                    class="fa-sharp fa-solid fa-check"
                    v-if="!category.deleted_at"
                  ></i>
                  <i class="fa-sharp fa-solid fa-xmark" v-else></i>
                </td>
                <td>
                  {{ new Date(category.created_at).toLocaleDateString() }}
                </td>
                <td v-if="useUser?.user?.is_admin">
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

import { useUserStore } from "../../../stores/UserStore";
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
    const useUser = useUserStore();
    console.log(useUser?.user);
    onMounted(() => {
      //   getMyArticles(useUser?.user?.id);
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
      }, 500);
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
