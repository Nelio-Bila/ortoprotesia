<template>
  <!-- <nav
    class="navbar navbar-expand d-flex flex-column align-item-start"
    id="sidebar"
  >
    <a href="/hp" class="navbar-brand text-light mt-5">
      <div class="display-5 font-weight-bold">THANOS</div>
    </a>
    <ul class="navbar-nav d-flex flex-column mt-5 w-100">
      <li class="nav-item w-100">
        <a href="/hp" class="nav-link text-link pl-4">Home</a>
      </li>
      <li class="nav-item w-100">
        <a href="/hp" class="nav-link text-link pl-4">About</a>
      </li>
      <li class="nav-item w-100">
        <a href="/hp" class="nav-link text-link pl-4">Blog</a>
      </li>
      <li class="nav-item w-100">
        <a href="/hp" class="nav-link text-link pl-4">Contact</a>
      </li>
    </ul>
  </nav> -->

  <nav
    id="sidebarMenu"
    class="
      col-md-3 col-lg-2
      d-md-block
      mt-5
      bg-primary
      text-white
      sidebar
      collapse
    "
  >
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
  </nav>
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
}

/* #sidebarMenu {
  width: 250px;
  height: 100vh;
  position: fixed;
  transition: 0.4s;
} */

.nav-link {
  font-size: 1.25em;
}

.nav-link:active,
.nav-link:focus,
.nav-link:hover {
  background-color: #ffffff26;
}

.open-nav {
  margin-left: 0px;
}
</style>
