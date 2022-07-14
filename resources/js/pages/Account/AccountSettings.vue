<template>
  <div>
    <NavBar />
    <div class="container align-items-center justify-content-center">
      <div class="row my-2">
        <div class="col-md-3 vertical-center">
          <div class="btn-group-vertical w-100 my-2">
            <router-link to="/account" class="btn btn-outline-secondary block">
              Dados pessoais
            </router-link>
            <router-link
              to="/account/security"
              class="btn btn-outline-secondary block"
              >Segurança</router-link
            >
            <router-link
              to="/account/privacy"
              class="btn btn-outline-secondary block"
              >Privacidade</router-link
            >
            <router-link to="/account/settings" class="btn btn-primary block"
              >Conta</router-link
            >
          </div>
        </div>
        <div class="col-md-7 mx-auto"></div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
</script>
