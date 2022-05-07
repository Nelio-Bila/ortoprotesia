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

export default {
  name: "Welcome",
  data() {
    return {
      user: null,
    };
  },
  async created() {
    const response = await axios.get("user");

    this.$store.commit("user", response.data);
    this.user = this.$tore.state.user;
  },
};
</script>
