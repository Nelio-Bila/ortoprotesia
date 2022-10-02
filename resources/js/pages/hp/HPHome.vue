<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="home" />

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid">
        <h1 class="mt-4">Painel do Profissional de Saúde</h1>
        <p>
          Nesta area podes gerir publicações, categorias, etiquetas e muito mais
        </p>
        <div class="row mb-2">
          <div class="col ">
            <div class="m-2 card text-center border border-primary rounded-3 hover:bg-primary hover:white" style="width: 12rem">
              <router-link to="/hp/articles" class="card-body">
                <h6 class="card-title">Publicações</h6>
                <p class="card-text">
                 <h1 class="text-bold"> {{ articles.length }}</h1>
                </p>
              </router-link>
            </div>
          </div>
          <div class="col ">
            <div class="m-2 card text-center border border-primary rounded-3 hover:bg-primary hover:white" style="width: 12rem">
              <router-link to="/hp/articles" class="card-body">
                <h6 class="card-title">Visualizações de hoje</h6>
                <p class="card-text">
                 <h1 class="text-bold"> {{ viewsTodayCount }}</h1>
                </p>
              </router-link>
            </div>
          </div>
          <div class="col ">
            <div class="m-2 card text-center border border-primary rounded-3 hover:bg-primary hover:white" style="width: 12rem">
              <router-link to="/hp/articles" class="card-body">
                <h6 class="card-title">Total Visualizações das minhas Publicações</h6>
                <p class="card-text">
                 <h1 class="text-bold"> {{ viewsCount }}</h1>
                </p>
              </router-link>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col">
            <apexchart
              width="400"
              type="area"
              :options="traficOptions"
              :series="userTypes"
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
import { watch, reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";

import HPSideBar from "../../components/HPSideBar.vue";
import HPNavBar from "../../components/HPNavBar.vue";

import { useUserStore } from "../../stores/UserStore";
import useArticles from "../../composables/articles";

const router = useRouter();

const traficOptions = reactive({
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
    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
  },
  colors: ["#273a7e", "#5072A7", "#902f37"],
  title: {
    text: "Trafego",
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

const userTypes = ref([
  {
    name: "Utentes",
    data: [30, 40, 45, 50, 49, 60, 70, 91],
  },
  {
    name: "Profissionais de Saúde",
    data: [20, 90, 25, 50, 19, 30, 40, 81],
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
} = useArticles(currentPage, rowsPerPage);

onMounted(() => {
  const useUser = useUserStore();
  getMyArticles(useUser?.user?.id);
  getMyViewsCount(useUser?.user?.id);
  getMyTodayViewsCount(useUser?.user?.id);
});

// const userStore = useUserStore();

// onMounted(() => {
//   if (!userStore.user?.is_hp) {
//     router.push("/hp/login");
//   }
// });
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
