<template>
  <VueAnnouncer class="sr-only" />
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
import { useAnnouncer } from "@vue-a11y/announcer";

const { assertive } = useAnnouncer();
assertive("My error notification");

// or

const { polite } = useAnnouncer();
polite("My info notification");
</script>
