<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Consulta</h3>
        </div>

        <ul class="list-unstyled components">
          <!-- <li class="active">
            <router-link to="/process/create" class="nav-link text-white"
              >Marcação de consulta</router-link
            >
          </li> -->
          <li class="active">
            <router-link to="/process" class="nav-link text-white"
              >Dados do processo</router-link
            >
          </li>

          <li>
            <router-link to="/consults" class="nav-link text-white"
              >Consultas</router-link
            >
          </li>
          <li>
            <router-link to="/consult/create" class="nav-link text-white"
              >Nova consulta</router-link
            >
          </li>
        </ul>
      </nav>

      <!-- Page Content -->
      <div
        id="content"
        class="container-fluid align-items-center justify-content-center"
      >
        <!-- We'll fill this with dummy content -->
        <div
          @click="toggleSideMenu"
          id="sidebarCollapse"
          class="my-2 text-primary cursor-pointer"
        >
          <i class="fas fa-align-left fa-2xl"></i>
        </div>
        <!-- <div class="container align-items-center justify-content-center"> -->
        <div class="row m-2">
          <div class="col mx-auto">
            <h1 class="text-center">Minhas consultas</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
    <Footer />
  </div>
</template>

<!-- <script>
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

export default {
  name: "ConsultIndex",
  data() {
    return {

    };
  },
  methods: {
    toggleSideMenu() {
      document.getElementById("sidebar").classList.toggle("active");
    },
  },
  components: { NavBar, Footer },
};
</script> -->

<script setup>
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

const toggleSideMenu = () => {
  document.getElementById("sidebar").classList.toggle("active");
};
</script>
