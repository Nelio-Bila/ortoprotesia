<template>
  <NavBar />
  <div class="container">
    <h1 class="text-center mb-5">{{ article.title }}</h1>
    <p>publicado aos {{}}</p>
    <div v-html="article.body"></div>
  </div>
  <Footer />
</template>

<script setup>
import { onMounted } from "vue";
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import { useRoute } from "vue-router";
import useArticles from "../../composables/articles";

const { article, getArticle } = useArticles();
const route = useRoute();

onMounted(() => {
  getArticle(route.params.id);
  console.log(route.params.id);
});
</script>
