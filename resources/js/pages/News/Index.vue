<template>
  <div>
    <NavBar />

    <div class="container">
      <h3 class="text-center mt-10 mb-5" style="margin-top: 20px">
        Últimas notícias
      </h3>
      <div class="row my-5 d-flex align-items-center">
        <span
          class="mx-2 col btn btn-sm btn-outline-secondary"
          @click.prevent="resetFilters"
        >
          Tudo
        </span>

        <div class="col" v-for="category in categories" :key="category.id">
          <button
            @click="filterCategory(category.id)"
            to="/news"
            class="btn btn-sm"
            :class="
              currentCategory === category.id
                ? 'btn-primary'
                : 'btn-outline-secondary'
            "
            style="width: 80%"
          >
            {{ category.name }}
          </button>
        </div>
      </div>
    </div>

    <div class="container" v-if="processing">
      <div class="row my-5">
        <div class="col text-center">
          <Spinner />
        </div>
      </div>
    </div>

    <p v-if="news.length < 1" class="text-center my-20">
      Sem noticias do momento
    </p>
    <div
      v-else
      class="container d-flex justify-content-center"
      style="margin-bottom: 10px"
      v-for="notice in news"
      :key="notice.id"
    >
      <div class="card" style="width: 80%">
        <div class="row no-gutters">
          <div
            class="
              col-sm-5 col-md-2
              d-flex
              justify-content-center
              align-items-center
            "
          >
            <img
              class="card-img"
              :src="notice.featuredImage"
              :alt="notice.title"
              style="max-height: 100px; max-width: 100px"
            />
          </div>
          <div class="col-sm-7 col-md-10">
            <div class="card-body">
              <h5 class="card-title">{{ notice.title }}</h5>
              <p class="card-text" v-html="notice.body"></p>
              <router-link
                :to="{
                  name: 'news.view',
                  params: { notice_id: notice.id },
                }"
                class="btn btn-primary"
                >Ler mais</router-link
              >
            </div>
          </div>
        </div>
      </div>
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

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

import PaginationComponent from "../../components/pagination/PaginationComponent.vue";
import Spinner from "../../components/Spinner.vue";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import useNews from "../../composables/news";
import useCategories from "../../composables/categories";

const currentCategory = ref(0);
const currentPage = ref(1);
const rowsPerPage = ref(10);

const { news, getNews, numberOfPages, getNewsByCategory } = useNews(
  currentPage,
  rowsPerPage
);
const { categories, getCategories } = useCategories();

const filterCategory = async (category_id) => {
  currentCategory.value = category_id;
  getNewsByCategory(category_id);
};

const resetFilters = async () => {
  currentCategory.value = 0;
  getNews();
};

onMounted(() => {
  getCategories();
  getNews();
});
</script>
