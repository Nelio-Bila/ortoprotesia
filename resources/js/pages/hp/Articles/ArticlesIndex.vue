<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="articles" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <router-link to="/hp/articles/create" class="btn btn-primary mb-2"
          >Escrever novo artigo</router-link
        >

        <table
          class="table table-striped table-responsive"
          id="articles_datatable"
        >
          <thead class="table-light">
            <tr>
              <th>Titulo</th>
              <th>Categoria</th>
              <th>Visualizações</th>
              <th>Autor</th>
              <th>Criada aos</th>
              <th>Acções</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="article in articles" :key="article.id">
              <tr>
                <td>{{ article.title }}</td>
                <td>{{ article.category.name }}</td>
                <td>{{ article.views }}</td>
                <td>
                  {{ article.hpro.name }}
                  {{ article.hpro.surname }}
                </td>
                <td>
                  {{ new Date(article.created_at).toLocaleDateString() }}
                </td>
                <td>
                  <router-link
                    class="btn btn-sm btn-success mx-2"
                    :to="{
                      name: 'articles.view',
                      params: { id: article.id },
                    }"
                    >Visualizar</router-link
                  >
                  <router-link
                    class="btn btn-sm btn-warning mx-2"
                    :to="{
                      name: 'articles.edit',
                      params: { id: article.id },
                    }"
                    >Editar</router-link
                  >

                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteArticle(article.id)"
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
import { onMounted, ref } from "vue";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

import useArticles from "../../../composables/articles";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const currentPage = ref(1);
const rowsPerPage = ref(20);

const { articles, getArticles, destroyArticle } = useArticles(
  currentPage,
  rowsPerPage
);
onMounted(() => {
  getArticles();
  setTimeout(() => {
    $("#articles_datatable").DataTable({
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

const deleteArticle = async (id) => {
  new Swal({
    title: "Eliminar esta publicação?",
    text: "Tens certeza? Não poderás reverter esta acção!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Eliminar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyArticle(id);
      getArticles();
    }
  });
};
</script>
