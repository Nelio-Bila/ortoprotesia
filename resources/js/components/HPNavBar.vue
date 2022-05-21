<template>
  <nav
    class="
      navbar navbar-expand-lg navbar-light
      bg-light
      mb-1
      sticky-top
      shadow
      h-72
      bl-0
    "
  >
    <i
      @click="toggleMenu"
      class="mx-3 fas fa-align-left fa-2xl text-primary cursor-pointer"
    ></i>

    <div class="me-auto"></div>

    <form class="d-flex justify-content-center my-2" v-if="!user">
      <router-link class="btn btn-outline-primary" to="/login">
        Entrar | Criar Conta
      </router-link>
    </form>
    <ul class="navbar-nav me-5 mb-2 mb-lg-0" v-if="user">
      <li class="nav-item dropdown me-5">
        <a
          class="nav-link dropdown-toggle me-5"
          href="#"
          id="navbarDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          {{ user.name }} {{ user.surname }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a v-if="user.carrier" class="dropdown-item" to="/hp/">Painel</a>
          </li>
          <li @click="handleLogout">
            <a class="dropdown-item" href="javascript:void(0)"
              >Terminar sessão</a
            >
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "HPNavbar",
  setup() {
    const toggleMenu = () => {
      document.getElementById("wrapper").classList.toggle("toggled");
    };

    const handleLogout = () => {
      localStorage.removeItem("op_token");
      setUser(null);
      $router.push("/");
    };

    return {
      toggleMenu,
      handleLogout,
    };
  },
  data() {
    return {
      user: null,
    };
  },
  async created() {
    await axios
      .get("user")
      .then((response) => {
        this.user = response.data;
      })
      .catch((ex) => {
        // this.$router.push("/");
      });
  },
};
</script>

<style scoped>
.h-72 {
  min-height: 76px;
}
</style>
