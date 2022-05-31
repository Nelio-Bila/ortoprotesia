<template>
  <nav
    class="
      navbar navbar-expand-lg navbar-light
      bg-light
      mb-1
      sticky-top
      shadow
      h-72
      bl-0
    "
  >
    <i
      @click="toggleMenu"
      class="mx-3 fas fa-align-left fa-2xl text-primary cursor-pointer"
    ></i>

    <div class="me-auto"></div>
    <ul class="navbar-nav me-5 mb-2 mb-lg-0" v-if="userStore.user != null">
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
            {{ userStore.user.name }}
          </span>

          <img
            v-if="userStore.user.avatar === 'avatar.png'"
            src="/storage/profile_imgs/avatar.png"
            class="rounded-circle"
            style="width: 40px"
            alt="Avatar"
          />
          <img
            v-else
            src="`${/storage/profile_imgs/}`+`${user.avatar}`"
            alt=""
          />
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a
              v-if="userStore.user.carrier"
              class="dropdown-item me-5"
              to="/hp/"
              >Painel</a
            >
          </li>
          <li>
            <router-link to="/account" class="dropdown-item me-5"
              >Definições da conta</router-link
            >
          </li>
          <li>
            <button
              class="dropdown-item me-5 cursor-pointer"
              @click.prevent="handleLogout"
            >
              Terminar sessão
            </button>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

import { useUserStore } from "../stores/UserStore";
import useAuth from "../composables/auth";

const router = useRouter();

const { logout } = useAuth();

const userStore = useUserStore();

const criteria = ref("");

const search = () => {
  router.push("/results/" + criteria.value);
};

const handleLogout = () => {
  logout();
};

onMounted(async () => {
  await axios
    .get("user")
    .then((response) => {
      userStore.setUser(response.data);
    })
    .catch((ex) => {});
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
