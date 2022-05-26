<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="users" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->
      <div class="container-fluid my-3">
        <router-link
          to="/users"
          class="btn btn-outline-primary d-inline-block me-3"
          ><i class="fa-solid fa-chevron-left"></i
        ></router-link>
        <span class="fs-2"> Detalhes do usuário {{ user.name }} </span>

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
  console.log(user);
});
</script>
