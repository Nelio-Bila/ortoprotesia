<template>
  <div class="my-2">
    <h1 class="text-center">Artigos</h1>
    <div class="row">
      <div class="col-md-3">
        <ArticleCard />
      </div>
      <div class="col-md-3">
        <ArticleCard />
      </div>
      <div class="col-md-3">
        <ArticleCard />
      </div>
      <div class="col-md-3">
        <ArticleCard />
      </div>
    </div>
    <nav aria-label="Page navigation">
      <ul class="pagination my-2 d-flex justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import ArticleCard from "./ArticleCard.vue";
export default {
  name: "ArticlesWrapper",
  components: {
    ArticleCard,
  },
};
</script>
