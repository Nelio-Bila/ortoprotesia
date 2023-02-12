<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Processo</h3>
        </div>

        <ul class="list-unstyled components">
          <!-- <li class="active">
            <router-link to="/process/create" class="nav-link text-white"
              >Abertura de processo</router-link
            >
          </li> -->
          <li class="active">
            <router-link to="/process" class="nav-link text-white"
              >Dados do processo</router-link
            >
          </li>
          <li>
            <router-link
              class="nav-link text-white"
              :to="{
                name: 'consult.index',
                params: { id: process.id },
              }"
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
            <h3 class="text-center">Dados do processo</h3>

            <div class="row mb-3 border p-2">
              <router-link
                :to="{
                  name: 'process.edit',
                }"
                class="btn btn-primary"
                >Editar</router-link
              >
            </div>
            <div class="row mb-3 border py-2">
              <label class="my-2">Endereço</label>
              <div class="col">
                <label for="province">Provincia</label>
                <input
                  id="province"
                  type="text"
                  class="form-control"
                  placeholder="Provincia"
                  :value="process.address?.province.name"
                />
              </div>
              <div class="col">
                <label for="district">Distrito</label>
                <input
                  id="district"
                  type="text"
                  class="form-control"
                  placeholder="Distrito"
                  :value="process.address?.district.name"
                />
              </div>
              <div class="col">
                <label for="neighbourhood">Bairro</label>
                <input
                  id="neighbourhood"
                  type="text"
                  class="form-control"
                  placeholder="Bairro"
                  :value="process.address?.neighbourhood.name"
                />
              </div>
            </div>

            <div class="row mb-3 border py-2">
              <label class="my-2">Bilhete de identidade</label>
              <div class="col">
                <label for="number">Numero</label>
                <input
                  id="number"
                  type="text"
                  class="form-control"
                  placeholder="Numero"
                  :value="process.identification?.number"
                />
              </div>
              <div class="col">
                <label for="archive">Arquivo de Identificação civil</label>
                <input
                  id="archive"
                  type="text"
                  class="form-control"
                  placeholder="Arquivo de identificação civil"
                  :value="process.identification?.archive"
                />
              </div>
              <div class="col">
                <label for="issueDate">Data de registo</label>
                <input
                  id="issueDate"
                  type="date"
                  class="form-control"
                  placeholder="Data de registo"
                  :value="process.identification?.issueDate"
                />
              </div>
            </div>

            <div class="row mb-3 py-2">
              <div class="col">
                <label for="maritalState">Estado civil</label>
                <input
                  id="maritalState"
                  type="text"
                  class="form-control"
                  placeholder="Estado civil"
                  :value="process.maritalState"
                />
              </div>
              <div class="col">
                <label for="genre">Genero</label>
                <input
                  id="genre"
                  type="text"
                  class="form-control"
                  placeholder="Genero"
                  :value="process.genre"
                />
              </div>
              <div class="col">
                <label for="race">Raça</label>
                <input
                  id="race"
                  type="text"
                  class="form-control"
                  placeholder="Genero"
                  :value="process.race"
                />
              </div>
            </div>
            <div class="row mb-3 py-2">
              <div class="col">
                <label for="phoneNumber">Telefone</label>
                <input
                  id="phoneNumber"
                  type="text"
                  class="form-control"
                  placeholder="Telefone"
                  :value="process.phoneNumber"
                />
              </div>
              <div class="col">
                <label for="profession">Profissão</label>
                <input
                  id="profession"
                  type="text"
                  class="form-control"
                  placeholder="profissão"
                  :value="process.profession"
                />
              </div>

              <div class="col">
                <label for="workPlace">Local de trabalho</label>
                <input
                  id="workPlace"
                  type="text"
                  class="form-control"
                  placeholder="Local de trabalho"
                  :value="process.workPlace"
                />
              </div>
            </div>
            <div class="row mb-3 py-2">
              <div class="col">
                <label for="naturality">Naturalidade</label>
                <input
                  id="naturality"
                  type="text"
                  class="form-control"
                  placeholder="Naturalidade"
                  :value="process.naturality"
                />
              </div>
              <div class="col">
                <label for="fatherName">Nome do pai</label>
                <input
                  id="fatherName"
                  type="text"
                  class="form-control"
                  placeholder="Nome do pai"
                  :value="process.naturality"
                />
              </div>
              <div class="col">
                <label for="motherName">Nome do mãe</label>
                <input
                  id="motherName"
                  type="text"
                  class="form-control"
                  placeholder="Nome do mãe"
                  :value="process.motherName"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>


<script setup>
import { reactive, computed, onMounted } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers, minLength } from "@vuelidate/validators";
import { useRoute } from "vue-router";

import useProcesses from "../../composables/processes";
import { useUserStore } from "../../stores/UserStore";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

const toggleSideMenu = () => {
  document.getElementById("sidebar").classList.toggle("active");
};

const route = useRoute();

const { getProcess, process } = useProcesses();

const userStore = useUserStore();

onMounted(() => {
  getProcess(userStore?.user?.id);
});
</script>
