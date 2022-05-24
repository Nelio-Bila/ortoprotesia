<template>
  <div>
    <NavBar />
    <div class="container">
      <Hero />
      <Carousel />
      <ArticlesWrapper />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import NavBar from "../components/NavBar.vue";
import Hero from "../components/Hero.vue";
import Carousel from "../components/Carousel.vue";
import ArticlesWrapper from "../components/ArticlesWrapper.vue";
import Footer from "../components/Footer.vue";
</script>
