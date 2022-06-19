<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="users" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->
      <div class="container-fluid my-3">
        <span class="fs-2"> Detalhes do usuário {{ user.name }} </span>
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/users">Usuários</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Detalhes de usuário
            </li>
          </ol>
        </nav>

        <div class="row my-5">
          <div class="col-md-8">
            <label class="text-muted" for="name">Nome:</label>
            <h5 id="name" class="fw-bold">
              {{ user.name }} {{ user.surname }}
            </h5>
            <label class="text-muted" for="age">Idade:</label>
            <h5 id="age" class="fw-bold">
              {{ user.birthdate }}
            </h5>
            <label class="text-muted" for="email">Email:</label>
            <h5 id="email" class="fw-bold">
              {{ user.email }}
            </h5>
            <label class="text-muted" for="status">Status:</label>
            <h5 id="status" class="fw-bold"></h5>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";

import HPSideBar from "../../../components/HPSideBar.vue";
import HPNavBar from "../../../components/HPNavBar.vue";
import useUsers from "../../../composables/users";

const route = useRoute();

const { user, getUser } = useUsers();

onMounted(() => {
  getUser(route.params.id);
});
</script>
