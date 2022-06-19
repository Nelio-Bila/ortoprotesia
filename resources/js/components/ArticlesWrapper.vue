<template>
  <div>
    <div class="my-2" id="articles" v-if="!criteria">
      <h1 class="text-center">Artigos</h1>
      <div class="row mx-1">
        <div class="col-md-3">
          <div class="row">
            <div class="col">
              <i class="fa-solid fa-filter mx-1 text-primary"></i>Filtros
              <span
                class="mx-2 btn btn-outline-secondary btn-sm"
                @click.prevent="resetFilters"
              >
                <i class="fa-solid fa-trash mx-1"></i>
                Limpar todos
              </span>
            </div>
          </div>

          <h5 class="my-2">Categorias</h5>

          <ul class="list-group">
            <li
              @click="filterCategory(category.id)"
              class="
                list-group-item
                d-flex
                justify-content-between
                align-items-center
                cursor-pointer
                hover:bg-medium
              "
              :class="currentCategory === category.id ? 'active' : ''"
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
              <span class="badge bg-primary rounded-pill">
                {{ category.articles.length }}</span
              >
            </li>
          </ul>

          <h5 class="my-2">Por data</h5>
          <select
            @change="filterDate"
            v-model="dateFilter"
            name="dateSelect"
            id="dateSelect"
            aria-label="Filtrar artigos por data"
            class="form-select"
          >
            <option value="selectPeriod" disabled>Selecione um período</option>
            <option value="week">Com menos de uma semana</option>
            <option value="month">Com menos de um mês</option>
            <option value="year">Com menos de um ano</option>
          </select>

          <h5 class="my-2">Por popularidade</h5>
          <select
            @change="filterPopularity"
            v-model="popularityFilter"
            name="popularitySelect"
            id="popularitySelect"
            aria-label="Filtrar artigos por vizualizações"
            class="form-select"
          >
            <option value="selectPop" disabled>Selecione uma opção</option>
            <option value="most">Top 10 Mais lidos</option>
            <option value="least">Top 10 Menos lidos</option>
          </select>
        </div>

        <div class="col-md-9">
          <div class="row my-5" v-if="processing">
            <div class="col text-center">
              <Spinner />
            </div>
          </div>
          <div v-else class="row">
            <ArticleCard
              v-for="article in articles"
              :article="article"
              :key="article.id"
            />
          </div>

          <div class="row d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
              <pagination-component
                class="pagination-component"
                v-model="currentPage"
                :numberOfPages="numberOfPages"
              />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Search page -->
    <div class="my-2" id="articles" v-if="criteria">
      <router-link to="/" class="btn btn-outline-primary"
        ><i class="fa-solid fa-chevron-left"></i
      ></router-link>
      <h1 class="text-center">Resultados</h1>
      <h2 class="text-center" v-if="!searchedArticles.length">
        Infelimente não foi encontrado algo relacionado a pesquisa
      </h2>
      <h2 class="text-center" v-else>Artigos</h2>
      <div class="row">
        <ArticleCard
          :article="article"
          v-for="article in searchedArticles"
          :key="article.id"
        />
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
          <pagination-component
            class="pagination-component"
            v-model="currentPage"
            :numberOfPages="numberOfPages"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, watch, ref, computed } from "vue";
import { useOnline } from "@vueuse/core";
import { useRoute } from "vue-router";

import Spinner from "./Spinner.vue";
import ArticleCard from "./ArticleCard.vue";
import PaginationComponent from "../components/pagination/PaginationComponent.vue";

import useArticles from "../composables/articles";
import useCategories from "../composables/categories";

const categoryFilter = ref("selectCategory");
const dateFilter = ref("selectPeriod");
const popularityFilter = ref("selectPop");

const { route } = useRoute();

const currentCategory = ref(0);
const currentPage = ref(1);
const rowsPerPage = ref(6);

const {
  articles,
  numberOfPages,
  getArticles,
  searchedArticles,
  searchArticles,
  getArticlesByCategory,
  getArticlesByDate,
  getArticlesByPopularity,
  processing,
} = useArticles(currentPage, rowsPerPage);

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

const filterCategory = async (category_id) => {
  currentCategory.value = category_id;
  getArticlesByCategory(category_id);
};

const filterDate = async () => {
  getArticlesByDate(dateFilter.value);
};

const filterPopularity = async () => {
  getArticlesByPopularity(popularityFilter.value);
};

const resetFilters = async () => {
  currentCategory.value = 0;
  getArticles();
};
</script>
