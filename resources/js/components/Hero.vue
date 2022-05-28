<template>
  <div class="px-4 py-2 my-2 text-center">
    <img
      class="d-block mx-auto mb-4"
      src="/images/logo.png"
      alt=""
      width="100"
      height="120"
    />
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">
        Nesta plataforma podes obter várias informações relacionadas com a
        Ortoprotesia em Moçambique e a Medicina Fisica e Reabilitação no geral.
      </p>
      <div
        v-if="!auth.user"
        class="d-grid gap-2 d-sm-flex justify-content-sm-center"
      >
        <router-link to="/login" class="btn btn-primary btn-lg px-4 gap-3">
          Entrar
        </router-link>
        <router-link
          to="register"
          class="btn btn-outline-secondary btn-lg px-4"
        >
          Criar conta
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from "../stores/UserStore";

const auth = useUserStore();
</script>
