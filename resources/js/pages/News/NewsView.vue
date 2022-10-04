<template>
  <NavBar />
  <div class="container my-3"></div>

  <Footer />
</template>



<script setup>
import { watch, onMounted, computed, ref } from "vue";
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import Spinner from "../../components/Spinner.vue";
import { useRoute } from "vue-router";
import useNews from "../../composables/news";

import { useRouter } from "vue-router";
import { useUserStore } from "../../stores/UserStore";

const currentPage = ref(1);
const rowsPerPage = ref(2);

const host = ref(process.env.MIX_APP_URL);

const {
  advert,
  getAdvert,
  latestNews,
  getLatestNews,
  news,
  getRelatedNews,
  processing,
} = useNews(currentPage, rowsPerPage);

const route = useRoute();

onMounted(() => {
  getNews(route.params.news_id);
  getLatestNews();
});

watch(advert, async (newAdvert, oldAdvert) => {
  if (newAdvert) {
    getRelatedArticles(advert.value.category_id, advert.value.id);
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
