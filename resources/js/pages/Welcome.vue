<template>
  <VueAnnouncer class="sr-only" />
  <div>
    <NavBar />
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <VerticalCarousel />
        </div>
        <div class="col-md-8">
          <Carousel />
        </div>
      </div>
      <ArticlesWrapper />
      <Hero />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import NavBar from "../components/NavBar.vue";
import Hero from "../components/Hero.vue";
import Carousel from "../components/Carousel.vue";
import VerticalCarousel from "../components/VerticalCarousel.vue";
import ArticlesWrapper from "../components/ArticlesWrapper.vue";
import Footer from "../components/Footer.vue";
import { useAnnouncer } from "@vue-a11y/announcer";

const { assertive } = useAnnouncer();
assertive("My error notification");

// or

const { polite } = useAnnouncer();
polite("My info notification");
</script>
