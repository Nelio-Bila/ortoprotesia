<template>
  <div class="row" v-if="loading">
    <div class="col text-center">
      <Spinner />
    </div>
  </div>
  <div v-else>
    <div class="my-2" id="articles" v-if="!criteria">
      <h1 class="text-center">Artigos</h1>
      <div class="row mx-1">
        <h4><i class="fa-solid fa-filter mx-3 text-primary"></i>Filtros</h4>
        <div class="col-md-4">
          <label for="categorySelect">Categorias</label>
          <select
            @change="filterCategory"
            v-model="categoryFilter"
            name="categorySelect"
            id="categorySelect"
            class="form-select"
            aria-label="Filtrar artigos por categoria"
          >
            <option disabled>Selecione uma categoria</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="categorySelect">Por data</label>
          <select
            @change="filterDate"
            v-model="dateFilter"
            name="dateSelect"
            id="dateSelect"
            aria-label="Filtrar artigos por data"
            class="form-select"
          >
            <option disabled>Selecione um período</option>
            <option value="week">Com menos de uma semana</option>
            <option value="month">Com menos de um mês</option>
            <option value="year">Com menos de um ano</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="categorySelect">Por popularidade</label>
          <select
            @change="filterPopularity"
            v-model="popularityFilter"
            name="popularitySelect"
            id="popularitySelect"
            aria-label="Filtrar artigos por vizualizações"
            class="form-select"
          >
            <option disabled>Selecione uma opção</option>
            <option value="most">Top 10 Mais lidos</option>
            <option value="least">Top 10 Menos lidos</option>
          </select>
        </div>
      </div>
      <div class="row">
        <ArticleCard
          :article="article"
          v-for="article in articles.data"
          :key="article.id"
        />
      </div>

      <Pagination
        :data="articles"
        @pagination-change-page="getArticles"
        class="my-2 d-flex justify-content-center"
      />
    </div>

    <div class="my-2" id="articles" v-if="criteria">
      <router-link to="/" class="btn btn-outline-primary"
        ><i class="fa-solid fa-chevron-left"></i
      ></router-link>
      <h1 class="text-center">Resultados</h1>
      <h2 class="text-center" v-if="!searchedArticles.length">
        Infelimente não foi encontrado algo relacionado a pesquisa
      </h2>
      <h2 class="text-center" v-if="searchedArticles.length">Artigos</h2>
      <div class="row">
        <ArticleCard
          :article="article"
          v-for="article in searchedArticles"
          :key="article.id"
        />
      </div>
      <nav aria-label="Page navigation">
        <ul class="pagination my-2 d-flex justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { onMounted, watch, ref, nextTick } from "vue";
import { useOnline } from "@vueuse/core";
import Pagination from "laravel-vue-pagination";

import Spinner from "./Spinner.vue";
import ArticleCard from "./ArticleCard.vue";
import useArticles from "../composables/articles";
import useCategories from "../composables/categories";

const loading = ref(true);
const categoryFilter = ref("");
const dateFilter = ref("");
const popularityFilter = ref("");

const {
  articles,
  getArticles,
  searchedArticles,
  searchArticles,
  getArticlesByCategory,
  getArticlesByDate,
  getArticlesByPopularity,
  processing,
} = useArticles();

const { categories, getCategories } = useCategories();

const props = defineProps(["criteria"]);

const online = useOnline();

watch(online, (on, off) => {
  if (on) {
    getArticles();
  }
});

onMounted(() => {
  getCategories();
  getArticles();
  searchArticles(props.criteria);
});

const filterCategory = async () => {
  getArticlesByCategory(categoryFilter.value);
};

const filterDate = async () => {
  getArticlesByDate(dateFilter.value);
};

const filterPopularity = async () => {
  getArticlesByPopularity(popularityFilter.value);
};

loading.value = processing.value;
</script>
