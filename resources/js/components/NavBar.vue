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
          <li class="nav-item">
            <router-link
              class="nav-link hover:primary"
              aria-current="page"
              to="/"
              >Inicio</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link hover:primary" to="/#news"
              >Noticias</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link hover:primary" to="/#articles"
              >Artigos</router-link
            >
          </li>
          <li class="nav-item hover:white">
            <a class="nav-link hover:primary" href="/forum">Forum</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle hover:primary"
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
                <router-link
                  class="dropdown-item hover:primary"
                  to="/process/info"
                  >Informações</router-link
                >
              </li>
              <li v-if="useUser?.get">
                <router-link
                  to="/consult/create"
                  class="dropdown-item hover:primary"
                  >Marcar</router-link
                >
              </li>
              <li v-if="useUser?.get">
                <hr class="dropdown-divider" />
              </li>
              <li v-if="useUser?.get">
                <a class="dropdown-item hover:primary" href="#"
                  >Estado da minha consulta</a
                >
              </li>
              <li v-if="useUser?.get">
                <router-link to="/process" class="dropdown-item hover:primary"
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
        <form class="d-flex justify-content-center my-2" v-if="!useUser?.get">
          <router-link class="btn btn-outline-primary" to="/login">
            Entrar | Criar Conta
          </router-link>
        </form>

        <ul class="navbar-nav me-5 mb-2 mb-lg-0" v-if="useUser?.get">
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
                {{ useUser?.get?.name }}
              </span>
              <img
                :src="`/images/profile_imgs/` + `${useUser?.get?.avatar}`"
                :alt="`${useUser?.get?.name} ${useUser?.get?.surname}`"
                class="rounded-circle mx-1"
                style="width: 40px"
              />
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <router-link
                  v-if="useUser?.user?.is_hp"
                  class="dropdown-item me-5"
                  to="/hp/"
                  >Painel</router-link
                >
              </li>
              <li>
                <router-link
                  v-if="useUser?.user?.is_admin"
                  class="dropdown-item me-5"
                  to="/admin/home"
                  >Painel</router-link
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
      </div>
    </div>
  </nav>
</template>


<script setup>
// 3rd party imports
import { ref } from "vue";
import { useRouter } from "vue-router";

// my imports
import { useUserStore } from "../stores/UserStore";
import useAuth from "../composables/auth";

// Composables
const useUser = useUserStore();
const router = useRouter();

// variables and functions
const { logout } = useAuth();

const criteria = ref("");

const search = () => {
  if (criteria.value === "") return;
  router.push("/results/" + criteria.value);
};

const handleLogout = () => {
  logout();
};
</script>


