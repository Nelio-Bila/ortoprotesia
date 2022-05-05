<template>
  <div class="container">
    <carousel />
    <div class="row justify-content-center mt-2">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Welcome</div>

          <div v-if="user" class="card-body">
            Bem vindo. {{ user.name }} {{ user.surname }}
          </div>
          <div v-if="!user" class="card-body">
            <router-link to="/login">Entrar</router-link><br />
            <router-link to="/register">Criar conta </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Welcome</div>

          <div v-if="user" class="card-body">
            Bem vindo. {{ user.name }} {{ user.surname }}
          </div>
          <div v-if="!user" class="card-body">
            <router-link to="/login">Entrar</router-link><br />
            <router-link to="/register">Criar conta </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Welcome</div>

          <div v-if="user" class="card-body">
            Bem vindo. {{ user.name }} {{ user.surname }}
          </div>
          <div v-if="!user" class="card-body">
            <router-link to="/login">Entrar</router-link><br />
            <router-link to="/register">Criar conta </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
// import { useStore } from "vuex";

import Carousel from "./Carousel.vue";

export default {
  name: "Welcome",
  data() {
    return {
      user: null,
    };
  },
  async created() {
    const response = await axios.get("user");

    // this.user = response.data;

    // this.$store.dispatch("user", response.data);
    this.$store.commit("user", response.data);
    this.user = this.$tore.state.user;
  },
  computed: {
    // ...mapGetters(["user"]),
  },
  components: {
    Carousel,
  },
};
</script>
