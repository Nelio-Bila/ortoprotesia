<template>
  <router-view />
</template>

<script>
import axios from "axios";
// import { mapGetters } from "vuex";
import { mapStores } from "pinia";
import { useUserStore } from "../stores/UserStore";

export default {
  name: "Home",

  async created() {
    // const response = await axios
    //   .get("user")
    //   .then((res) => console.log(res))
    //   .catch((ex) => console.log(ex));
    // this.$store.commit("user", response.data);
    // this.user = this.$tore.state.user;
  },
  computed: {
    ...mapStores(useUserStore),
  },
};
</script>
