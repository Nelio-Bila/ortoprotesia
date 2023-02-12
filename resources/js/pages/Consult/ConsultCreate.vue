<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Consulta</h3>
        </div>

        <ul class="list-unstyled components">
          <li class="active">
            <router-link to="/process" class="nav-link text-white"
              >Dados do processo</router-link
            >
          </li>
          <li>
            <router-link to="/consults" class="nav-link text-white"
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
        <div class="row m-2">
          <div class="col mx-auto">
            <form @submit.prevent="saveConsult">
              <h3 class="text-center">Marcação de consulta</h3>
              <!-- Consult session -->
              <div class="row">
                <div class="col">
                  <div class="form-group mb-3">
                    <label for="consult_session_id"
                      >Selecione o tipo e a data da consulta</label
                    >
                    <select
                      @blur="v$.consult_session_id.$touch"
                      class="form-select"
                      :class="{
                        'is-invalid': v$.consult_session_id.$error,
                        'is-valid': !v$.consult_session_id.$invalid,
                      }"
                      v-model="form.consult_session_id"
                    >
                      <option
                        :value="consult_session.id"
                        v-for="consult_session in consultSessions"
                        :key="consult_session.id"
                      >
                        {{ consult_session.type }} ({{ consult_session.date }})
                      </option>
                    </select>

                    <span
                      class="invalid-feedback"
                      v-for="error of v$.consult_session_id.$errors"
                      :key="error.$uid"
                    >
                      {{ error.$message }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Story -->
              <div class="row">
                <div class="col">
                  <div class="form-group mb-3">
                    <label for="story"
                      >Descreva o que lhe faz marcar esta consulta</label
                    >
                    <textarea
                      @blur="v$.story.$touch"
                      class="form-control"
                      :class="{
                        'is-invalid': v$.story.$error,
                        'is-valid': !v$.story.$invalid,
                      }"
                      v-model="form.story"
                      placeholder="Sintomas e sinais"
                    >
                    </textarea>

                    <span
                      class="invalid-feedback"
                      v-for="error of v$.story.$errors"
                      :key="error.$uid"
                    >
                      {{ error.$message }}
                    </span>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary btn-block btn-lg">
                <span
                  v-if="processing"
                  class="spinner-border spinner-border-sm mx-2"
                  role="status"
                  aria-hidden="true"
                ></span>
                <span v-if="processing">Processando...</span>

                <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
                <span v-if="!processing">Salvar</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, computed, ref, onMounted } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers } from "@vuelidate/validators";
import { useUserStore } from "../../stores/UserStore";
import axios from "axios";

import NavBar from "../../components/NavBar.vue";
import useConsults from "../../composables/consults";
import useConsultSessions from "../../composables/consultSessions";
import useProcesses from "../../composables/processes";

export default {
  setup() {
    const form = reactive({
      story: "",
      process_id: "",
      consult_session_id: "",
    });

    const { processing, errors, storeConsult } = useConsults();
    const { consultSessions, getConsultSessions } = useConsultSessions();
    const { process, getProcess } = useProcesses();

    onMounted(() => {
      getConsultSessions();
    });

    const rules = computed(() => ({
      story: {
        required: helpers.withMessage("Por favor indique a história", required),
      },
      process_id: {},
      consult_session_id: {
        required: helpers.withMessage("Por favor indique a data", required),
      },
    }));

    const v$ = useVuelidate(rules, form);

    const toggleSideMenu = () => {
      document.getElementById("sidebar").classList.toggle("active");
    };

    const saveConsult = async () => {
      const useUser = useUserStore();

      await axios
        .get("/process/" + useUser.user.id)
        .then((response) => {
          form.process_id = response.data.id;
        })
        .catch((ex) => {
          console.log(ex);
        });

      v$._value.$validate();
      if (!v$._value.$invalid) {
        await storeConsult({ ...form });
      } else {
        processing.value = false;
      }
    };

    return {
      processing,
      errors,
      saveConsult,
      consultSessions,
      v$,
      form,
      toggleSideMenu,
    };
  },
  components: { NavBar },
};
</script>


<!-- <script>
import axios from "axios";
import useValidate from "@vuelidate/core";
import {
  required,
  email,
  sameAs,
  helpers,
  minLength,
} from "@vuelidate/validators";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

export default {
  name: "ConsultCreate",
  data() {
    return {
      v$: useValidate(),
      consult: {
        process_id: "",
        consult_session_id: "",
      },
      processing: false,
      errors_exist: false,
      validationErrors: null,
    };
  },
  methods: {
    toggleSideMenu() {
      document.getElementById("sidebar").classList.toggle("active");
    },
    async handleSubmit() {
      this.processing = true;
      this.v$.$validate();
      if (!this.v$.$error) {
        await axios
          .post("process/register", {
            province: this.address.province,
            district: this.address.district,
            neighbourhood: this.address.neighbourhood,
          })
          .then((response) => {
            this.processing = false;
            this.$router.push("/login");
          })
          .catch((ex) => {
            this.processing = false;
            switch (ex.response.status) {
              case 422:
                this.validationErrors = ex.response.data.errors;
                this.errors_exist = true;
                break;
            }
          });
      } else {
        this.processing = false;
      }
    },
  },
  validations() {
    return {
      consult: {
        type: {
          required: helpers.withMessage(
            "Por favor selecione o tipo de consulta",
            required
          ),
        },
        date: {
          required: helpers.withMessage("Por favor selecione a data", required),
        },
      },
      processing: {},
      errors_exist: {},
      validationErrors: {},
    };
  },
  components: { NavBar, Footer },
};
</script> -->
