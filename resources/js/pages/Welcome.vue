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

<script>
import axios from "axios";

import NavBar from "../components/NavBar.vue";
import Hero from "../components/Hero.vue";
import Carousel from "../components/Carousel.vue";
import ArticlesWrapper from "../components/ArticlesWrapper.vue";
import Footer from "../components/Footer.vue";

import { useUserStore } from "../stores/UserStore";

export default {
  name: "Welcome",
  data() {
    return {
      user: useUserStore(),
    };
  },
  async created() {
    // const response = await axios.get("user");
    // this.user = useUserStore();
    // this.user.setUser(response.data);
    // this.user = user.getUser();
  },
  components: {
    NavBar,
    Hero,
    Carousel,
    ArticlesWrapper,
    Footer,
  },
};
</script>
