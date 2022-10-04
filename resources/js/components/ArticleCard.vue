<template>
  <div class="col-lg-6">
    <div class="row justify-content-center mt-2 mx-1">
      <div class="card mb-3" style="max-width: 540px">
        <div class="row g-0">
          <div class="col-md-4 vertical-center">
            <img
              :src="article.featuredImage"
              class="img-thumbnail rounded mt-3 mt-md-0"
              :alt="article.title"
            />
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title fw-bolder">{{ article.title }}</h5>
              <p class="card-text">
                {{ article.postExcerpt }}
              </p>
              <p class="card-text m-0">
                <small class="text-primary"
                  >Por: {{ article.hpro.name }}
                  {{ article.hpro.surname }}</small
                >
                <small class="text-muted mx-3"
                  >aos
                  {{ new Date(article.created_at).toLocaleDateString() }}</small
                >
              </p>
              <p class="mt-0">
                <i class="fa-solid fa-eye"></i> {{ article.views.length }}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <router-link
                  :to="`/articles/${article.id}`"
                  class="btn btn-primary"
                  >Ler mais...</router-link
                >
              </div>
            </div>
          </div>
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
