<template>
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
        v-if="useUser?.user?.is_hp"
      >
        <h5><i class="fa-solid fa-house me-2"></i> Inicio</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'home' ? 'active-link' : ''"
        aria-current="page"
        to="/admin/home"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-house me-2"></i> Inicio</h5>
      </router-link>

      <router-link
        class="nav-link text-white"
        :class="currentLink === 'news' ? 'active-link' : 'text-white'"
        to="/admin/news"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-newspaper me-2"></i> Noticias</h5>
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
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-users me-2"></i> Utentes</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'health_pros' ? 'active-link' : 'text-white'"
        to="/admin/hpros"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-users me-2"></i> Prof. de Saúde</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'processes' ? 'active-link' : 'text-white'"
        to="/processes"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-box-archive me-2"></i> Processos Clinícos</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="
          currentLink === 'consultsessions' ? 'active-link' : 'text-white'
        "
        to="/consultsessions"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-calendar-check me-2"></i> Consultas</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        :class="currentLink === 'admins' ? 'active-link' : 'text-white'"
        to="/admins"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-shield me-2"></i> Admins</h5>
      </router-link>
      <router-link
        class="nav-link text-white"
        to="/hp"
        v-if="useUser?.user?.is_admin"
      >
        <h5><i class="fa-solid fa-chart-column me-2"></i> Estatisticas</h5>
      </router-link>
    </div>
  </nav>
  <!-- /#sidebar-wrapper -->
</template>

<script setup>
import { useUserStore } from "../stores/UserStore";
const props = defineProps({
  currentLink: String,
});

const useUser = useUserStore();
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
  padding: 7px;
}

.nav-link:active,
.nav-link:focus,
.nav-link:hover {
  background-color: #ffffff26;
}
</style>
