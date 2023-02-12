<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="consultsessions" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <div
          class="
            d-flex
            justify-content-between
            flex-wrap flex-md-nowrap
            align-items-center
            pt-3
            pb-2
            mb-3
            border-bottom
          "
        >
          <h1 class="h2">
            Sessão de consultas de {{ consultSession.type }} de
            {{ consultSession.date }}
          </h1>
        </div>
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/consultsessions"
                >Sessões de consultas</router-link
              >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Vizualizar Sessão de consultas
            </li>
          </ol>
        </nav>

        <div class="row">
          <div class="col">
            <div class="form-group mb-3">
              <label for="date">Tipo de consulta</label>
              <input
                type="text"
                readonly
                :value="consultSession.type"
                class="form-control"
              />
            </div>
          </div>
          <div class="col">
            <div class="form-group mb-3">
              <label for="date">Data a realizar-se</label>
              <input
                readonly
                type="date"
                class="form-control"
                :value="consultSession.date"
              />
            </div>
          </div>
        </div>

        <h3>Solicitações de consultas para esta sessão</h3>
        <div class="col text-center my-3" v-if="!consultSession.consults">
          <Spinner />
        </div>
        <p class="my-5 text-center" v-if="!consultSession.consults?.length">
          Sem solicitações neste momento
        </p>
        <div
          class="card mb-3"
          v-for="consult_session in consultSession.consults"
          :key="consult_session.id"
        >
          <div class="row g-0">
            <div class="col">
              <div class="card-body">
                <h5 class="card-title">
                  {{ consult_session?.process?.user?.name }}
                </h5>
                <p class="card-text">
                  {{ consult_session.story }}
                </p>
                <p class="card-text">
                  <small class="text-muted">{{
                    consult_session.createdDateHumanReadable
                  }}</small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

  <script setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";

import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";
import useConsultSessions from "../../../composables/consultSessions";
import Spinner from "../../../components/Spinner.vue";

const route = useRoute();

const { processing, errors, consultSession, getConsultSession } =
  useConsultSessions();

onMounted(() => {
  getConsultSession(route.params.id);
});
</script>
