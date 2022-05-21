<template>
  <nav
    class="
      navbar navbar-expand-lg navbar-light
      bg-light
      shadow
      p-3
      mb-1
      sticky-top
    "
  >
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/"
        ><img
          src="/images/logo.png"
          alt="logotipo da Ortoprotesia"
          width="40"
          height="60"
      /></router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="/"
              >Inicio</router-link
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Forum</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Consultas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <router-link to="/appointment" class="dropdown-item" href="#"
                  >Marcar</router-link
                >
              </li>
              <li>
                <a class="dropdown-item" href="#">Informações</a>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" href="#">Estado da minha consulta</a>
              </li>
              <li>
                <router-link to="/process" class="dropdown-item"
                  >Processo clínico</router-link
                >
              </li>
            </ul>
          </li>
        </ul>

        <form class="form-inline mx-5">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
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
        <ul class="navbar-nav me-5 mb-2 mb-lg-0" v-if="user !== null">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <div
                class="
                  rounded-full
                  border border-secondary
                  rounded-full
                  inline-block
                  p-2
                "
              >
                <i
                  v-if="user.avatar === 'avatar.png'"
                  class="fa-solid fa-user fa-2x m-2"
                ></i>
                <img
                  v-else
                  src="`${images/profiles/}`+`${user.avatar}`"
                  alt=""
                />
              </div>
              <!-- {{ user.name }} {{ user.surname }} -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a v-if="user.carrier" class="dropdown-item me-5" to="/hp/"
                  >Painel</a
                >
              </li>
              <li>
                <router-link to="/account" class="dropdown-item me-5"
                  >Definições da conta</router-link
                >
              </li>
              <li @click="handleLogout">
                <a class="dropdown-item me-5" href="javascript:void(0)"
                  >Terminar sessão</a
                >
              </li>
            </ul>
          </li>
        </ul>
        <!-- </div> -->
      </div>
    </div>
  </nav>
</template>


<script>
import { mapStores, mapState, mapActions } from "pinia";
import { useUserStore } from "../stores/UserStore";

export default {
  name: "NavBar",
  methods: {
    ...mapActions(useUserStore, ["setUser", "removeUser"]),

    handleLogout() {
      localStorage.removeItem("op_token");
      this.setUser(null);
      this.$router.push("/");
    },
  },
  computed: {
    ...mapStores(useUserStore),
    ...mapState(useUserStore, ["user"]),
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
        this.setUser(this.user);
      })
      .catch((ex) => {
        // this.$router.push("/");
      });
  },
};
</script>


