<template>
  <div>
    <NavBar />
    <div class="container">
      <ArticlesWrapper :criteria="crit" />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from "vue";
import NavBar from "../components/NavBar.vue";
import ArticlesWrapper from "../components/ArticlesWrapper.vue";
import Footer from "../components/Footer.vue";
import { useRoute } from "vue-router";

const route = useRoute();

const crit = ref(route.params.criteria);
</script>
