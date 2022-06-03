<template>
  <div class="px-4 py-2 my-2 text-center">
    <img
      class="d-block mx-auto mb-4"
      src="/images/logo.png"
      alt=""
      width="100"
      height="120"
    />
    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12">
        <div
          class="card shadow-lg border-0 rounded-lg mt-5 mx-auto"
          style="width: 30rem"
        >
          <h3 class="card-header display-1 text-muted text-center">404</h3>

          <span class="card-subtitle mb-2 text-muted text-center">
            Infelizmente a página não foi encontrada
          </span>

          <div class="card-body mx-auto">
            <button
              @click.prevent="goBack"
              class="btn btn-sm btn-secondary text-white mx-2"
            >
              <i class="fa-solid fa-chevron-left mx-2"></i>Voltar a pagina
              anterior
            </button>

            <router-link
              type="button"
              class="btn btn-sm btn-primary text-white mx-2"
              to="/"
              >Ir a pagina inicial</router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();
const goBack = () => {
  router.go(-1);
};
</script>

<style scoped>
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.04);
  border-radius: 0.25rem;
}

.card .card-header {
  background-color: #fff;
  border-bottom: none;
}
</style>>

