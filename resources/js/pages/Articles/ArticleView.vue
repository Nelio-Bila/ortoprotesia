<template>
  <NavBar />
  <div class="container my-3">
    <button @click.prevent="goBack" class="btn btn-outline-primary">
      <i class="fa-solid fa-chevron-left"></i>
    </button>

    <h1 class="text-center mb-5">{{ article.title }}</h1>

    <div class="row mb-3">
      <div class="col text-primary">
        <i class="fa-solid fa-calendar-days fa-2xl mx-3"></i>Publicado aos
        {{ new Date(article.created_at).toLocaleDateString() }}
      </div>
      <div class="col text-primary" v-if="article.hpro">
        <i class="fa-solid fa-user-nurse fa-2xl mx-3"></i>Autor:
        {{ article.hpro.name }}
        {{ article.hpro.surname }}
      </div>
      <div class="col text-primary" v-if="article.category">
        <i class="fa-solid fa-tag fa-2xl mx-3"></i>Categoria:
        {{ article.category.name }}
      </div>
      <div class="col text-primary">
        <i class="fa-solid fa-eye fa-xl mx-3"></i> {{ article?.views?.length }}
        <span v-if="article?.views?.length === 1">Visualização</span>
        <span v-else>Visualizações</span>
      </div>
    </div>

    <div class="row">
      <div class="col text-center my-3" v-if="processing">
        <Spinner />
      </div>
      <div v-else class="col text-center my-3">
        <img
          :src="article.featuredImage"
          :alt="article.title"
          class="img"
          width="600"
          height="500"
        />
        <article v-html="article.body"></article>
      </div>

      <div class="col-md-3">
        <div
          class="btn-group-vertical w-100 mb-5"
          role="group"
          aria-label="First group"
        >
          <div class="btn btn-primary p-3">Artigos relacionados</div>

          <div
            class="btn btn-outline-secondary p-1 mb-0 w-100 vertical-center"
            v-if="processing"
          >
            <Spinner class="horizontal-center" />
          </div>

          <router-link
            v-else
            v-for="article in articles"
            :key="article.id"
            :to="`/articles/${article.slug}`"
            class="btn btn-outline-secondary p-1 mb-0 w-100"
          >
            <div class="row">
              <div class="col vertical-center">
                <img
                  :src="article.featuredImage"
                  :alt="article.title"
                  class="img img-thumbnail"
                />
              </div>
              <div class="col text-start">
                <h4 class="fw-bolder">{{ article.title }}</h4>
                <p class="text-small m-0">
                  <i class="fa-solid fa-user-nurse mx-2"></i>
                  <small
                    >{{ article.hpro.name }} {{ article.hpro.surname }}</small
                  >
                </p>
                <p class="text-small m-0">
                  <i class="fa-solid fa-calendar-days mx-2"></i>
                  <small>{{
                    new Date(article.created_at).toLocaleDateString()
                  }}</small>
                </p>
                <p class="text-small m-0">
                  <i class="fa-solid fa-eye mx-2"></i>
                  {{ article.views.length }}
                </p>
              </div>
            </div>
          </router-link>
        </div>

        <div
          class="btn-group-vertical w-100 mb-5"
          role="group"
          aria-label="First group"
        >
          <div class="btn btn-primary p-3">Artigos recentes</div>
          <div
            class="btn btn-outline-secondary p-1 mb-0 w-100 vertical-center"
            v-if="processing"
          >
            <Spinner class="horizontal-center" />
          </div>

          <router-link
            v-else
            v-for="article in latestArticles"
            :key="article.id"
            :to="`/articles/${article.slug}`"
            class="btn btn-outline-secondary p-1 mb-0 w-100"
          >
            <div class="row">
              <div class="col vertical-center">
                <img
                  :src="article.featuredImage"
                  :alt="article.title"
                  class="img img-thumbnail"
                />
              </div>
              <div class="col text-start">
                <h4 class="fw-bolder">{{ article.title }}</h4>
                <p class="text-small m-0">
                  <i class="fa-solid fa-user-nurse mx-2"></i>
                  <small
                    >{{ article.hpro.name }} {{ article.hpro.surname }}</small
                  >
                </p>
                <p class="text-small m-0">
                  <i class="fa-solid fa-calendar-days mx-2"></i>
                  <small>{{
                    new Date(article.created_at).toLocaleDateString()
                  }}</small>
                </p>
                <p class="text-small m-0">
                  <i class="fa-solid fa-eye mx-2"></i>
                  {{ article.views.length }}
                </p>
              </div>
            </div>
          </router-link>
        </div>

        <div
          class="list-group-vertical w-100 mb-5 rounded"
          role="group"
          aria-label="First group"
        >
          <div class="list-group-item active p-3">Partilhar este artigo</div>
          <div class="list-group-item p-3 text-center">
            <ShareNetwork
              network="facebook"
              :url="`${host}${route.path}`"
              :title="article.title"
              :description="article.title"
              :quote="article.postExcerpt"
              hashtags="MedicinaFisicaEReabilitação,Ortoprotesia"
            >
              <i class="fa-brands fa-facebook-square fa-4x mx-2"></i>
            </ShareNetwork>
            <ShareNetwork
              network="twitter"
              :url="`${host}${route.path}`"
              :title="article.title"
              :description="article.title"
              :quote="article.postExcerpt"
              hashtags="MedicinaFisicaEReabilitação,Ortoprotesia"
            >
              <i class="fa-brands fa-twitter-square fa-4x mx-2"></i>
            </ShareNetwork>
            <ShareNetwork
              network="Email"
              :url="`${host}${route.path}`"
              :title="article.title"
              :description="article.title"
              :quote="article.postExcerpt"
              hashtags="MedicinaFisicaEReabilitação,Ortoprotesia"
            >
              <i class="fa-solid fa-square-envelope fa-4x mx-2"></i>
            </ShareNetwork>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>

<script setup>
import { watch, onMounted, computed, ref } from "vue";
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import Spinner from "../../components/Spinner.vue";
import { useRoute } from "vue-router";
import useArticles from "../../composables/articles";

import { useRouter } from "vue-router";
import { useUserStore } from "../../stores/UserStore";

const currentPage = ref(1);
const rowsPerPage = ref(2);

const host = ref(process.env.MIX_APP_URL);

const {
  article,
  getArticle,
  latestArticles,
  getLatestArticles,
  articles,
  getRelatedArticles,
  incrementArticleViews,
  processing,
} = useArticles(currentPage, rowsPerPage);

const route = useRoute();

onMounted(() => {
  getArticle(route.params.slug);
  getLatestArticles();
  const useUser = useUserStore();
  let who = "user";
  if (useUser?.getIsAdmin) {
    who = "admin";
  } else if (useUser?.getIsHP) {
    who = "hp";
  }
  incrementArticleViews(route.params.article_id, useUser?.user?.id, who);
});

watch(article, async (newArticle, oldArticle) => {
  if (newArticle) {
    getRelatedArticles(article.value.category_id, article.value.id);
  }
});

const router = useRouter();
const goBack = () => {
  router.go(-1);
};
</script>

<style scoped>
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
</style>
