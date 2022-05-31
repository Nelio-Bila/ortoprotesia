<template>
  <nav
    class="
      navbar navbar-expand-lg navbar-light
      bg-light
      shadow
      p-3
      mb-1
      sticky-top
    "
  >
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/"
        ><img
          src="/images/logo.png"
          alt="logotipo da Ortoprotesia"
          width="40"
          height="60"
      /></router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item hover:bg-primary">
            <router-link class="nav-link active" aria-current="page" to="/"
              >Inicio</router-link
            >
          </li>
          <li class="nav-item hover:bg-primary">
            <a class="nav-link" href="#news">Noticias</a>
          </li>
          <li class="nav-item hover:bg-primary">
            <a class="nav-link" href="#articles">Artigos</a>
          </li>
          <li class="nav-item hover:bg-primary hover:white">
            <a class="nav-link" href="#">Forum</a>
          </li>
          <li class="nav-item dropdown hover:bg-primary">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Consultas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <router-link to="/consult/create" class="dropdown-item"
                  >Marcar</router-link
                >
              </li>
              <li>
                <a class="dropdown-item" href="#">Informações</a>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" href="#">Estado da minha consulta</a>
              </li>
              <li>
                <router-link to="/process" class="dropdown-item"
                  >Processo clínico</router-link
                >
              </li>
            </ul>
          </li>
        </ul>

        <form class="form-inline mx-5" @submit.prevent="search">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="Pesquisar"
              aria-label="Search"
              aria-describedby="basic-addon1"
              v-model="criteria"
            />
            <button class="input-group-text cursor-pointer" type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </form>
        <form class="d-flex justify-content-center my-2" v-if="!userStore.user">
          <router-link class="btn btn-outline-primary" to="/login">
            Entrar | Criar Conta
          </router-link>
        </form>

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
              <li @click="handleLogout">
                <a class="dropdown-item me-5" href="javascript:void(0)"
                  >Terminar sessão</a
                >
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
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
</script>


