<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="home" />

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid">
        <h1 class="mt-4">Bem vindo de volta</h1>
        <p>
          Nesta area podes gerir publicações, categorias, etiquetas e muito mais
        </p>
        <div class="row">
          <router-link
            to="/hp/articles"
            class="col-md-3 col-xl-3 text-decoration-none"
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
            to="/admin/hpros"
            class="col-md-3 col-xl-3 text-decoration-none"
          >
            <div class="card bg-c-green order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Prof. de Saúde</h6>
                <h2 class="text-right">
                  <i
                    class="fa-solid fa-user-nurse f-left text-white"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ hpros.length }}</span>
                </h2>
              </div>
            </div>
          </router-link>

          <router-link
            to="/users"
            class="col-md-3 col-xl-3 text-decoration-none"
          >
            <div class="card bg-c-yellow order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Utentes registrados</h6>
                <h2 class="text-right">
                  <i
                    class="fa fa-user f-left text-white"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ users.length }}</span>
                </h2>
              </div>
            </div>
          </router-link>

          <router-link
            to="/processes"
            class="col-md-3 col-xl-3 text-decoration-none"
          >
            <div class="card bg-c-yellow order-card hover:transparent">
              <div class="card-block">
                <h6 class="m-b-20 text-white">Processos</h6>
                <h2 class="text-right">
                  <i
                    class="fa fa-archive f-left text-white"
                    style="margin-right: 15px"
                  ></i
                  ><span class="text-white">{{ processes.length }}</span>
                </h2>
                <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
              </div>
            </div>
          </router-link>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <apexchart
              width="900"
              type="area"
              :options="traficOptions"
              :series="userTypes"
            ></apexchart>
          </div>
        </div>
        <div class="row">
          <div class="col d-flex justify-content-center aligns-items-center">
            <apexchart
              width="500"
              type="pie"
              :options="topicsOptions"
              :series="topicsOptions.chart.series"
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
import useUsers from "../../composables/users";
import useArticles from "../../composables/articles";
import useHPros from "../../composables/hpros";
import useProcesses from "../../composables/processes";

import HPSideBar from "../../components/HPSideBar.vue";
import HPNavBar from "../../components/HPNavBar.vue";

import { useUserStore } from "../../stores/UserStore";
import pinia from "../../stores/store";

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
  yaxis: [
    {
      labels: {
        formatter: function (val) {
          return val.toFixed(0);
        },
      },
    },
  ],
  colors: ["#273a7e", "#902f37", "#f9cf00", "#5072A7"],
  title: {
    text: "Registo de Usuários",
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
  dataLabels: {
    enabled: true,
    enabledOnSeries: [1],
  },
}));

const userTypes = computed(() => [
  {
    name: "Utentes",
    data: usersSeries.value,
  },
  {
    name: "Profissionais de Saúde",
    data: hpSeries.value,
  },
]);

const topicsOptions = computed(() => ({
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
    labels: catnames.value,
    series: articlesViewsPerCategory.value,
  },
  colors: ["#273a7e", "#5072A7", "#902f37", "#f9cf00"],
  title: {
    text: "Visualizações por categoria",
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
  labels: catnames.value,
}));

const currentPage = ref(1);
const rowsPerPage = ref(20);
const { getUsers, users } = useUsers();
const { getArticles, articles } = useArticles(currentPage, rowsPerPage);
const { hpros, getHPros } = useHPros();
const { processes, getProcesses } = useProcesses();

const days = ref();
const usersSeries = ref();
const hpSeries = ref();
const getRegistersPerDay = async () => {
  await axios
    .get("/registersPerDay")
    .then((response) => {
      days.value = response.data.days;
      usersSeries.value = response.data.newUsersPerDay;
      hpSeries.value = response.data.newHPsPerDay;
    })
    .catch((ex) => {
      console.log(ex);
    });
};

const catnames = ref();
const articlesViewsPerCategory = ref();
const getReadersPerCategory = async () => {
  await axios
    .get("/readersPerCategory")
    .then((response) => {
      catnames.value = response.data.catnames;
      articlesViewsPerCategory.value = response.data.articlesViewsPerCategory;
    })
    .catch((ex) => {
      console.log(ex);
    });
};

onMounted(() => {
  getUsers();
  getArticles(currentPage);
  getHPros();
  getProcesses();
  getRegistersPerDay();
  getReadersPerCategory();
});

// const userStore = useUserStore();

// onMounted(() => {
//   if (userStore.user) {
//     if (!userStore.user?.is_admin) {
//       router.push("/admin/login");
//     }
//   } else {
//     router.push("/admin/login");
//   }
// });

// watch(userStore.user, async (newUserStore, oldUserStore) => {
//   if (newUserStore === null) {
//     router.push("/admin/login");
//   }
// });
</script>


<script>
import { useUserStore } from "../../stores/UserStore";
import useAdmins from "../../composables/admins";

export default {
  beforeRouteEnter: function (to, from, next) {
    const userStore = useUserStore();
    if (to.name !== "admin.login" && !userStore?.user?.is_admin)
      next({ name: "admin.login" });
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
