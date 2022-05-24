<template>
  <NavBar />
  <div class="container my-3">
    <router-link to="/" class="btn btn-outline-primary"
      ><i class="fa-solid fa-chevron-left"></i
    ></router-link>
    <h1 class="text-center mb-5">{{ article.title }}</h1>
    <div class="row mb-3">
      <div class="col text-primary">
        <i class="fa-solid fa-calendar-days fa-2xl mx-3"></i>Publicado aos
        {{ new Date(article.created_at).toLocaleDateString() }}
      </div>
      <div class="col text-primary" v-if="article.hpro">
        <i class="fa-solid fa-user-nurse fa-2xl mx-3"></i>Autor:
        {{ article.hpro.name }}
        {{ article.hpro.surname }}
      </div>
      <div class="col text-primary" v-if="article.category">
        <i class="fa-solid fa-tag fa-2xl mx-3"></i>Categoria:
        {{ article.category.name }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-9" v-html="article.body"></div>
      <div class="col-md-3">
        <div
          class="btn-group-vertical w-100"
          role="group"
          aria-label="First group"
        >
          <div class="btn btn-primary p-3">Artigos relacionados</div>

          <router-link
            v-for="article in articles"
            :key="article.id"
            :to="`/articles/${article.id}`"
            class="btn btn-outline-secondary p-1 mb-0 w-100"
          >
            <h4>{{ article.title }}</h4>
            <p class="text-small">
              {{ new Date(article.created_at).toLocaleDateString() }}
            </p>
          </router-link>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import { watch, onMounted, computed } from "vue";
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import { useRoute } from "vue-router";
import useArticles from "../../composables/articles";

const { article, getArticle, articles, getRelatedArticles } = useArticles();
const route = useRoute();

onMounted(() => {
  getArticle(route.params.id);
});

watch(article, async (newArticle, oldArticle) => {
  if (newArticle) {
    getRelatedArticles(article.value.category_id, article.value.id);
  }
});
</script>
