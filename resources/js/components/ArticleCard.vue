<template>
  <!-- <div class="col-lg-6">
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
  </div> -->
  <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
    <router-link
      :to="`/articles/${article.slug}`"
      class="card"
      style="
        text-decoration: none;
        :hover {
          opacity: 0.5;
        }
      "
    >
      <img :src="article.featuredImage" class="card-img" :alt="article.title" />
      <div class="card-img-overlay">
        <span class="btn btn-light btn-sm" style="cursor: default">{{
          article.category.name
        }}</span>
      </div>
      <div class="card-body">
        <h6 class="card-title">{{ article.title }}</h6>
        <small class="text-muted cat">
          <i class="far fa-clock text-primary mr-2"></i>
          {{ article.createdDateHumanReadable }}
          <i class="fas fa-user text-primary"></i> {{ article.hpro.name }}
          {{ article.hpro.surname }}
        </small>
        <!-- <p class="card-text"></p> -->

        <!-- <router-link :to="`/articles/${article.id}`" class="btn btn-primary"
          >Ler mais...</router-link
        > -->
      </div>
      <div
        class="
          card-footer
          text-muted
          d-flex
          justify-content-between
          bg-transparent
          border-top-0
        "
      >
        <div class="views">
          {{ new Date(article.created_at).toLocaleDateString() }}
        </div>
        <div class="stats">
          <i class="far fa-eye"></i> {{ article.views.length }}
          <!-- <i class="far fa-comment"></i> 12 -->
        </div>
      </div>
    </router-link>
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

<style scoped>
body {
  padding: 2rem 0rem;
}

.card-img {
  border-bottom-left-radius: 0px;
  border-bottom-right-radius: 0px;
}

.card-title {
  margin-bottom: 0.2rem;
}

.cat {
  display: inline-block;
  /* margin-bottom: 1rem; */
}

.fa-users {
  margin-left: 1rem;
}

.card-footer {
  font-size: 0.8rem;
}
</style>
