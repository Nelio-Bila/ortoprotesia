<template>
  <div class="row justify-content-center mt-2">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Welcome</div>

        <div v-if="user" class="card-body">Titulo</div>
        <div class="card-body">
          <h3>Image</h3>
          <h4>Trecho</h4>
          <div>botoes</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArticleCard',
};
</script>
