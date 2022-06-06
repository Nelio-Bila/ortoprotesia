<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="health_pros" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->
      <div class="container-fluid my-3">
        <span class="fs-2"> Detalhes do profissional {{ hpro.name }} </span>
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/admin/hpros"
                >Profissionais de saúde</router-link
              >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Detalhes de profissional de saúde
            </li>
          </ol>
        </nav>
        <div class="row mb-3 text-center">
          <div class="relative inline-block">
            <img
              :src="`/images/profile_imgs/${hpro.avatar}`"
              alt=""
              class="h-52 w-52 rounded-full object-cover"
            />
          </div>
        </div>

        <div class="row m-5">
          <div class="col-md-6">
            <label class="text-muted" for="name">Nome:</label>
            <h5 id="name" class="fw-bold">
              {{ hpro.name }} {{ hpro.surname }}
            </h5>
            <label class="text-muted" for="age">Idade:</label>
            <h5 id="age" class="fw-bold">
              {{ hpro.birthdate }}
            </h5>
            <label class="text-muted" for="email">Email:</label>
            <h5 id="email" class="fw-bold">
              {{ hpro.email }}
            </h5>
            <label class="text-muted" for="status">Status:</label>
            <h5 id="status" class="fw-bold" v-if="hpro.is_hp">Activo</h5>
            <h5 id="status" class="fw-bold" v-else>Inactivo</h5>
          </div>
          <div class="col-md-6">
            <label class="text-muted" for="name">Carreira:</label>
            <h5 id="name" class="fw-bold">
              {{ hpro.carrier }}
            </h5>
            <label class="text-muted" for="name">Categoria:</label>
            <h5 id="name" class="fw-bold">
              {{ hpro.category }}
            </h5>
            <label class="text-muted" for="name">Instituição:</label>
            <h5 id="name" class="fw-bold">
              {{ hpro.institution }}
            </h5>
            <label class="text-muted" for="name">Departamento:</label>
            <h5 id="name" class="fw-bold">
              {{ hpro.department }}
            </h5>
          </div>
        </div>

        <div class="row m-5">
          <div class="col-md-6">
            <label class="text-muted" for="name"
              >Data de inicio das funções:</label
            >
            <h5 id="name" class="fw-bold">
              {{ hpro.startingWorkDate }}
            </h5>
          </div>
          <div class="col-md-6">
            <label class="text-muted" for="name">Verificado:</label>
            <h5 id="name" class="fw-bold" v-if="hpro.verified">
              <i class="fa fa-check fa-solid"></i>
            </h5>
            <h5 id="name" class="fw-bold" v-if="!hpro.verified">
              <i class="fa fa-x fa-solid"></i>
            </h5>
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
import useHPros from "../../../composables/hpros";
import AvatarInput from "../../../components/AvatarInput.vue";

const route = useRoute();

const { hpro, getHPro } = useHPros();

onMounted(async () => {
  getHPro(route.params.id);
});
</script>
