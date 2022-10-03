<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="home" />

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container mt-4">
        <h1>Painel do Profissional de Saúde</h1>
        <p>
          Nesta area podes gerir publicações, categorias, etiquetas e muito mais
        </p>
        <div class="row">
          <router-link
            to="/hp/articles"
            class="col-md-4 col-xl-4 text-decoration-none"
          >
            <div class="card bg-c-blue order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Publicações</h6>
                <h2 class="text-right">
                  <i
                    class="text-white fa-sharp fa-solid fa-newspaper mr-5"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ articles.length }}</span>
                </h2>
              </div>
            </div>
          </router-link>

          <router-link
            to="/hp/articles"
            class="col-md-4 col-xl-4 text-decoration-none"
          >
            <div class="card bg-c-green order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Visualizações de hoje</h6>
                <h2 class="text-right">
                  <i
                    class="fa fa-eye f-left text-white"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ viewsTodayCount }}</span>
                </h2>
              </div>
            </div>
          </router-link>

          <router-link
            to="/hp/articles"
            class="col-md-4 col-xl-4 text-decoration-none"
          >
            <div class="card bg-c-yellow order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Total Visualizações</h6>
                <h2 class="text-right">
                  <i
                    class="fa fa-eye f-left text-white"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ viewsCount }}</span>
                </h2>
                <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
              </div>
            </div>
          </router-link>
        </div>

        <div class="row">
          <div class="col">
            <apexchart
              id="trafficChart"
              ref="trafficChart"
              width="400"
              type="area"
              :options="traficOptions"
              :series="userTypes"
              @mounted="trafficMounted"
            ></apexchart>
          </div>

          <div class="col">
            <apexchart
              width="400"
              type="pie"
              :options="topicsOptions"
              :series="topics"
            ></apexchart>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>

<script setup>
import { watch, reactive, ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

import HPSideBar from "../../components/HPSideBar.vue";
import HPNavBar from "../../components/HPNavBar.vue";

import { useUserStore } from "../../stores/UserStore";
import useArticles from "../../composables/articles";

const router = useRouter();

const traficOptions = computed(() => ({
  chart: {
    id: "app-traffic",
    fontFamily: "Raleway,Nunito, sans-serif",
    foreColor: "#273a7e",
    animations: {
      enabled: true,
      easing: "easeinout",
      speed: 800,
      animateGradually: {
        enabled: true,
        delay: 150,
      },
      dynamicAnimation: {
        enabled: true,
        speed: 350,
      },
    },
  },
  xaxis: {
    categories: days.value,
  },
  colors: ["#273a7e", "#5072A7", "#902f37"],
  title: {
    text: "Leituras por dia",
    align: "left",
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize: "16px",
      fontWeight: "bolder",
      fontFamily: "Raleway",
      color: "#902f37",
    },
  },
}));

let userTypes = computed(() => [
  {
    name: "Utentes",
    data: series.value,
  },
]);

const topicsOptions = reactive({
  chart: {
    id: "traffic-by-topic",
    fontFamily: "Raleway,Nunito, sans-serif",
    foreColor: "#273a7e",
    animations: {
      enabled: true,
      easing: "easeinout",
      speed: 800,
      animateGradually: {
        enabled: true,
        delay: 150,
      },
      dynamicAnimation: {
        enabled: true,
        speed: 350,
      },
    },
    labels: ["Proteses", "Ortoteses", "Auxiliares de Marcha", "Outros"],
    series: [30, 40, 45, 50],
  },
  colors: ["#273a7e", "#5072A7", "#902f37", "#f9cf00"],
  title: {
    text: "Trafego por tópico",
    align: "left",
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize: "16px",
      fontWeight: "bolder",
      fontFamily: "Raleway",
      color: "#902f37",
    },
  },
});

const topics = ref([30, 40, 45, 50]);

const currentPage = ref(1);
const rowsPerPage = ref(20);

const {
  articles,
  getMyArticles,
  getMyViewsCount,
  viewsCount,
  getMyTodayViewsCount,
  viewsTodayCount,
  //   articlesViewsPerDay,
  //   getArticlesViewsPerDay,
} = useArticles(currentPage, rowsPerPage);

onMounted(() => {
  const useUser = useUserStore();
  getMyArticles(useUser?.user?.id);
  getMyViewsCount(useUser?.user?.id);
  getMyTodayViewsCount(useUser?.user?.id);
  getArticlesViewsPerDay(useUser?.user?.id);
});

const days = ref();
const series = ref();
const getArticlesViewsPerDay = async (id) => {
  await axios
    .get("/articles/views/day/" + id)
    .then((response) => {
      series.value = response.data.ArticlesViewsPerDay;
      days.value = response.data.days;
    })
    .catch((ex) => {
      console.log(ex);
    });
};
</script>


<script>
import { useUserStore } from "../../stores/UserStore";

export default {
  beforeRouteEnter: function (to, from, next) {
    const userStore = useUserStore();
    if (to.name !== "hplogin" && !userStore.user?.is_hp)
      next({ name: "hplogin" });
    else next();
  },
};
</script>

<style scoped>
order-card {
  color: #fff;
}

.bg-c-blue {
  background: #f9cf00;
}

.bg-c-green {
  background: #902f37;
}

.bg-c-yellow {
  background: #273a7e;
}

.bg-c-pink {
  background: #4caf50;
}

.card {
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
  box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
  border: none;
  margin-bottom: 30px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.card .card-block {
  padding: 25px;
}

.order-card i {
  font-size: 26px;
}

.f-left {
  float: left;
}

.f-right {
  float: right;
}
</style>
