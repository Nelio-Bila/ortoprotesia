<template>
  <div class="col-md-3">
    <div class="row justify-content-center mt-2 mx-1">
      <div class="card px-0">
        <h5 class="card-header">{{ article.title }}</h5>
        <div class="card-body">
          <h5 class="card-title">{{ article.title }}</h5>
          <p class="card-text">
            {{ article.postExcerpt }}
          </p>
          <router-link :to="`/articles/${article.id}`" class="btn btn-primary"
            >Ler mais...</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
});
</script>
