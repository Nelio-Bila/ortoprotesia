<template>
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
          <router-link
            type="button"
            class="btn btn-sm btn-info text-white"
            to="/"
            >Ir a pagina inicial</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotFound",
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

