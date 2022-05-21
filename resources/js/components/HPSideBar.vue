<template>
  <!-- <nav
    class="
      col-md-3 col-lg-2
      d-md-block
      mt-5
      bg-primary
      text-white
      sidebar
      collapse
    "
    id="sidebar-wrapper"
  >
    <div class="sidebar-heading bg-light text-center">
      <router-link class="navbar-brand" to="/"
        ><img
          src="/images/logo.png"
          alt="logotipo da Ortoprotesia"
          width="40"
          height="60"
      /></router-link>
    </div>
    <div class="position-sticky">
      <ul class="nav flex-column pt-3">
        <li
          class="nav-item py-1"
          :class="currentLink === 'home' ? 'active-link' : ''"
        >
          <router-link
            class="nav-link"
            :class="currentLink === 'home' ? 'active' : ''"
            aria-current="page"
            to="/hp"
          >
            <h5><i class="fa-solid fa-house me-2"></i> Inicio</h5>
          </router-link>
        </li>
        <li
          class="nav-item py-1"
          :class="currentLink === 'articles' ? 'active-link' : ''"
        >
          <router-link
            class="nav-link"
            :class="currentLink === 'articles' ? 'active' : 'text-white'"
            to="/hp/articles"
          >
            <h5><i class="fa-solid fa-newspaper me-2"></i> Publicações</h5>
          </router-link>
        </li>
        <li
          class="nav-item py-1"
          :class="currentLink === 'categories' ? 'active-link' : ''"
        >
          <router-link
            class="nav-link"
            :class="currentLink === 'categories' ? 'active' : 'text-white'"
            to="/categories"
          >
            <h5><i class="fa-solid fa-tags me-2"></i> Categorias</h5>
          </router-link>
        </li>
        <li
          class="nav-item py-1"
          :class="currentLink === 'users' ? 'active-link' : ''"
        >
          <router-link
            class="nav-link"
            :class="currentLink === 'users' ? 'active' : 'text-white'"
            to="/admin/users"
          >
            <h5><i class="fa-solid fa-users me-2"></i> Usuários</h5>
          </router-link>
        </li>
        <li
          class="nav-item py-1"
          :class="currentLink === 'consults' ? 'active-link' : ''"
        >
          <router-link
            class="nav-link"
            :class="currentLink === 'consults' ? 'active' : 'text-white'"
            to="/hp"
          >
            <h5><i class="fa-solid fa-calendar-check me-2"></i> Consultas</h5>
          </router-link>
        </li>
        <li class="nav-item py-1">
          <router-link class="nav-link text-white" to="/hp">
            <h5><i class="fa-solid fa-chart-column me-2"></i> Estatisticas</h5>
          </router-link>
        </li>
      </ul>
    </div>
  </nav> -->
  <!-- Sidebar -->
  <nav class="bg-primary" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
      <router-link to="/" class="text-center bg-light py-2 h-72">
        <img
          src="/images/logo.png"
          alt="logotipo da Ortoprotesia"
          width="40"
          height="60"
        />
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'home' ? 'active-link' : ''"
        aria-current="page"
        to="/hp"
      >
        <h5><i class="fa-solid fa-house me-2"></i> Inicio</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'articles' ? 'active-link' : 'text-white'"
        to="/hp/articles"
      >
        <h5><i class="fa-solid fa-newspaper me-2"></i> Publicações</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'categories' ? 'active-link' : 'text-white'"
        to="/categories"
      >
        <h5><i class="fa-solid fa-tags me-2"></i> Categorias</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'users' ? 'active-link' : 'text-white'"
        to="/users"
      >
        <h5><i class="fa-solid fa-users me-2"></i> Usuários</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'health_pros' ? 'active-link' : 'text-white'"
        to="/admin/health_pros"
      >
        <h5><i class="fa-solid fa-users me-2"></i> Prof. de Saúde</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'consults' ? 'active-link' : 'text-white'"
        to="/hp"
      >
        <h5><i class="fa-solid fa-box-archive me-2"></i> Processos Clinícos</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'consults' ? 'active-link' : 'text-white'"
        to="/hp"
      >
        <h5><i class="fa-solid fa-calendar-check me-2"></i> Consultas</h5>
      </router-link>
      <router-link class="nav-link text-white" to="/hp">
        <h5><i class="fa-solid fa-chart-column me-2"></i> Estatisticas</h5>
      </router-link>
    </div>
  </nav>
  <!-- /#sidebar-wrapper -->
</template>

<script>
export default {
  name: "HPSideBar",
  props: ["currentLink"],
};
</script>

<style scoped>
li:hover {
  background-color: #92400e;
  color: #fff;
}

.active-link {
  border-right-style: solid;
  border-right-color: #f9cf00;
  border-right-width: 5px;
  background-color: #92400e;
}

.nav-link {
  font-size: 1.25em;
}

.nav-link:active,
.nav-link:focus,
.nav-link:hover {
  background-color: #ffffff26;
}
</style>
