<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="home" />

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid">
        <h1 class="mt-4">Bem vindo(a)</h1>
        <p>
          Nesta area podes gerir publicações, categorias, etiquetas e muito mais
        </p>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>

<script setup>
import { onMounted } from "vue";

import HPSideBar from "../../components/HPSideBar.vue";
import HPNavBar from "../../components/HPNavBar.vue";
</script>
