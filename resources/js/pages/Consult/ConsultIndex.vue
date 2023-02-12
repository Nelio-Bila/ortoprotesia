<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Consulta</h3>
        </div>

        <ul class="list-unstyled components">
          <!-- <li class="active">
            <router-link to="/process/create" class="nav-link text-white"
              >Marcação de consulta</router-link
            >
          </li> -->
          <li class="active">
            <router-link to="/process" class="nav-link text-white"
              >Dados do processo</router-link
            >
          </li>

          <li>
            <router-link to="/consult/create" class="nav-link text-white"
              >Nova consulta</router-link
            >
          </li>
        </ul>
      </nav>

      <!-- Page Content -->
      <div
        id="content"
        class="container-fluid align-items-center justify-content-center"
      >
        <!-- We'll fill this with dummy content -->
        <div
          @click="toggleSideMenu"
          id="sidebarCollapse"
          class="my-2 text-primary cursor-pointer"
        >
          <i class="fas fa-align-left fa-2xl"></i>
        </div>
        <!-- <div class="container align-items-center justify-content-center"> -->
        <div class="row m-2">
          <div class="col mx-auto">
            <h1 class="text-center">Minhas consultas</h1>

            <div class="col text-center my-3" v-if="!consults">
              <Spinner />
            </div>
            <p class="my-5 text-center" v-if="!consults?.length">
              Sem consultas neste momento
            </p>
            <div
              class="card mb-3"
              v-for="consult in consults"
              :key="consult.id"
            >
              <div class="row g-0">
                <div class="col">
                  <div class="card-body">
                    <h5 class="card-title">
                      Consulta de: {{ consult?.consult_session?.type }}
                    </h5>
                    <p class="card-text">
                      {{ consult.story }}
                    </p>
                    <p class="card-text">
                      <small class="text-muted">{{
                        consult.createdDateHumanReadable
                      }}</small>
                    </p>
                    <div class="card-footer">
                      <button
                        @click="deleteConsult(consult.id)"
                        class="btn btn-danger"
                      >
                        Cancelar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { onMounted, watch } from "vue";
import { useUserStore } from "../../stores/UserStore";
import NavBar from "../../components/NavBar.vue";
import Spinner from "../../components/Spinner.vue";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
import $ from "jquery";
import { useRoute } from "vue-router";

import useConsults from "../../composables/consults";

const toggleSideMenu = () => {
  document.getElementById("sidebar").classList.toggle("active");
};

const { consults, getMyConsults, destroyConsult } = useConsults();

const route = useRoute();
onMounted(() => {
  getMyConsults(route.params.id);
});

watch(
  () => route.params.id,
  async (newId) => {
    getMyConsults(newId);
  }
);

const deleteConsult = async (id) => {
  new Swal({
    title: "Cancelar esta consulta?",
    text: "Tens certeza? Não poderás reverter esta acção!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#902f37",
    confirmButtonText: "Sim, Cancelar!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      destroyConsult(id);
      getMyConsults("1163e116-d1ee-4c8f-ae13-ac91e963ca6f");
    }
  });
};
</script>
