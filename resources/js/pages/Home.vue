<template>
  <NavBar />
  <div class="container align-items-center justify-content-center">
    <router-view :user="user" />
  </div>
  <Footer />
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

import NavBar from "../components/NavBar.vue";
import Login from "../components/Login.vue";
import Carousel from "../components/Carousel.vue";

export default {
  name: "Home",
  components: {
    NavBar,
    Login,
    Carousel,
  },

  async created() {
    const response = await axios
      .get("user")
      .then((res) => console.log(res))
      .catch((ex) => console.log(ex));

    this.$store.commit("user", response.data);

    this.user = this.$tore.state.user;
  },
  computed: {
    ...mapGetters(["user"]),
  },
};
</script>
