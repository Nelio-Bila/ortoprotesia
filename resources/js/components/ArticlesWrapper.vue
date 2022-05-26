<template>
  <div class="my-2" id="articles" v-if="!criteria">
    <h1 class="text-center">Artigos</h1>
    <div class="row">
      <ArticleCard
        :article="article"
        v-for="article in articles"
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
  <div class="my-2" id="articles" v-if="criteria">
    <h1 class="text-center">Resultados</h1>
    <h2 class="text-center" v-if="!searchedArticles">
      Infelimente não foi encontrado algo relacionado a pesquisa
    </h2>
    <h2 class="text-center">Artigos</h2>
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
</template>

<script setup>
import { onMounted } from "vue";
import ArticleCard from "./ArticleCard.vue";
import useArticles from "../composables/articles";

const { articles, getArticles, searchedArticles, searchArticles } =
  useArticles();

const props = defineProps(["criteria"]);

onMounted(() => {
  getArticles();
  searchArticles(props.criteria);
});
</script>
