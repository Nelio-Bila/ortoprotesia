<template>
  <nav
    id="sidebarMenu"
    class="col-md-3 col-lg-2 d-md-block bg-primary text-white sidebar collapse"
  >
    <div class="position-sticky pt-3">
      <ul class="nav flex-column d-flex justify-content-center">
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" to="/hp">
            <i class="fa-solid fa-house"></i>
            Inicio
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/hp">
            <i class="fa-solid fa-newspaper"></i>
            Publicações
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/hp">
            <i class="fa-solid fa-tags"></i>
            Categorias
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/hp">
            <i class="fa-solid fa-users"></i>
            Usuários
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/hp">
            <i class="fa-solid fa-calendar-check"></i>
            Consultas
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white" to="/hp">
            <i class="fa-solid fa-chart-column"></i>
            Estatisticas
          </router-link>
        </li>
      </ul>

      <!-- <h6
        class="
          sidebar-heading
          d-flex
          justify-content-between
          align-items-center
          px-3
          mt-4
          mb-1
          text-muted
        "
      >
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Year-end sale
          </a>
        </li>
      </ul> -->
    </div>
  </nav>
</template>

<script>
export default {
  name: "HPSideBar",
  props: ["currentLink"],
};
</script>

<style scoped>
nav-item:hover {
  background-color: #243773;
}
</style>
