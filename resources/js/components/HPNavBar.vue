<template>
  <nav
    class="navbar navbar-expand-lg navbar-light bg-light mb-1 shadow h-72 bl-0"
  >
    <i
      @click="toggleMenu"
      class="mx-3 fas fa-align-left fa-2xl text-primary cursor-pointer"
    ></i>

    <div class="me-auto"></div>
    <ul class="navbar-nav me-5 mb-2 mb-lg-0" v-if="auth">
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <span class="mx-2">
            {{ auth.name }}
          </span>
          <img
            :src="`/images/profile_imgs/` + `${auth.avatar}`"
            :alt="`${auth.name} ${auth.surname}`"
            class="rounded-circle mx-1"
            style="width: 40px"
          />
        </a>
        <ul class="dropdown-menu me-5" aria-labelledby="navbarDropdown">
          <li>
            <a v-if="auth.carrier" class="dropdown-item me-5" to="/hp/"
              >Painel</a
            >
          </li>
          <li>
            <router-link to="/account" class="dropdown-item me-5"
              >Definições da conta</router-link
            >
          </li>
          <li
            class="dropdown-item me-5 cursor-pointer"
            @click.prevent="handleLogout"
          >
            Terminar sessão
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

import useAuth from "../composables/auth";

const router = useRouter();



const { hplogout, auth, getUser } = useAuth();

const criteria = ref("");

const search = () => {
  router.push("/results/" + criteria.value);
};

const handleLogout = () => {
  hplogout();
};

onMounted(async () => {
  getUser();
});

const toggleMenu = () => {
  document.getElementById("wrapper").classList.toggle("toggled");
};
</script>

<style scoped>
.h-72 {
  min-height: 76px;
}
</style>
