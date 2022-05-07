<template>
  <router-view :user="user" />
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "Home",

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
