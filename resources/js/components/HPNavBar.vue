<template>
  <header
    class="
      navbar navbar-secondary
      sticky-top
      bg-gray-200
      flex-md-nowrap
      p-0
      shadow
    "
  >
    <router-link
      class="
        navbar-brand
        bg-light
        col-md-3 col-lg-2
        me-0
        px-3
        text-center
        me-auto
      "
      to="/"
      ><img
        src="/images/logo.png"
        alt="logotipo da Ortoprotesia"
        width="30"
        height="40"
    /></router-link>
    <!-- <button
      class="navbar-toggler position-absolute d-md-none collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu"
      aria-controls="sidebarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <input
      class="form-control form-control-dark w-100"
      type="text"
      placeholder="Pesquisar"
      aria-label="Search"
    />
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#">Terminar sessão</a>
      </div>
    </div> -->
    <form class="form-inline mx-5">
      <div class="input-group">
        <input
          type="text"
          class="form-control form-control-light"
          placeholder="Pesquisar"
          aria-label="Search"
          aria-describedby="basic-addon1"
        />
        <button class="input-group-text" type="button">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </form>
    <form class="d-flex justify-content-center my-2" v-if="!user">
      <router-link class="btn btn-outline-primary" to="/login">
        Entrar | Criar Conta
      </router-link>
    </form>
    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
    <ul class="navbar-nav me-5 mb-2 mb-lg-0">
      <li class="nav-item dropdown" v-if="user">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          {{ user.name }} {{ user.surname }}
        </a>
        <ul
          class="dropdown-menu"
          aria-labelledby="navbarDropdown"
          @click="handleLogout"
        >
          <li>
            <a v-if="user.carrier" class="dropdown-item" to="/hp/">Painel</a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0)"
              >Terminar sessão</a
            >
          </li>
        </ul>
      </li>
    </ul>
  </header>
</template>

<script>
export default {
  name: "HPNavbar",
};
</script>

<style>
</style>
