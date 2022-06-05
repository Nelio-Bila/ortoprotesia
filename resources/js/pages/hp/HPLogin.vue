<template>
  <div>
    <NavBar />
    <div class="row my-2">
      <div class="col-md-5 mx-auto">
        <form @submit.prevent="handleSubmit" class="mt-5">
          <h3 class="text-center">Inicio de sessão</h3>
          <p class="text-center">Como profissional de saúde</p>
          <div v-if="errors_exist">
            <div
              v-for="(field, k) in errors"
              :key="k"
              class="
                alert alert-danger
                d-flex
                align-items-center
                alert-dismissible
                fade
                show
              "
              role="alert"
            >
              <svg
                class="bi flex-shrink-0 me-2"
                width="24"
                height="24"
                role="img"
                aria-label="Danger:"
              >
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div v-for="error in field" :key="error">{{ error }}</div>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
          </div>
          <div v-if="isLoginInvalid">
            <div
              class="
                alert alert-danger
                d-flex
                align-items-center
                alert-dismissible
                fade
                show
              "
              role="alert"
            >
              <svg
                class="bi flex-shrink-0 me-2"
                width="24"
                height="24"
                role="img"
                aria-label="Danger:"
              >
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>{{ invalid_credentials }}</div>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input
              @blur="v$.email.$touch"
              type="email"
              class="form-control"
              :class="{
                'is-invalid': v$.email.$error,
                'is-valid': !v$.email.$invalid,
              }"
              placeholder="Email"
              v-model="v$.email.$model"
            />
            <span class="invalid-feedback" v-if="v$.email.$error">
              {{ v$.email.$errors[0].$message }}
            </span>
          </div>
          <div class="form-group mb-3">
            <label for="password">Palavra passe</label>
            <input
              type="password"
              @blur="v$.password.$touch"
              class="form-control"
              :class="v$.password.$error ? 'is-invalid' : ''"
              placeholder="Palavra passe"
              v-model="v$.password.$model"
            />
            <span class="invalid-feedback" v-if="v$.password.$error">
              {{ v$.password.$errors[0].$message }}
            </span>
          </div>
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              v-model="remember_me"
            />
            <label class="form-check-label" for="flexCheckDefault">
              Manter me logado
            </label>
          </div>

          <button class="btn btn-primary btn-block mb-3" :disabled="processing">
            <i
              v-if="processing"
              class="fa-solid fa-spinner fa-spin-pulse mx-2"
            ></i>
            <span v-if="processing">Entrando...</span>

            <i
              v-if="!processing"
              class="fa-solid fa-arrow-right-to-bracket mx-2"
            ></i>
            <span v-if="!processing">Entrar</span></button
          ><br />
          <div class="d-flex justify-content-between">
            <router-link class="" to="register">Criar conta</router-link>
            <router-link class="" to="forgot"
              >Esqueci a palavra passe</router-link
            >
          </div>
        </form>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import useValidate from "@vuelidate/core";
import { required, email, helpers } from "@vuelidate/validators";
import { useUserStore } from "../../stores/UserStore";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

export default {
  name: "HPLogin",
  data() {
    return {
      v$: useValidate(),
      email: "",
      password: "",
      processing: false,
      remember_me: false,
      errors_exist: false,
      validationErrors: [],
      isLoginInvalid: false,
      invalid_credentials: "",
    };
  },
  methods: {
    async handleSubmit() {
      this.processing = true;
      this.v$.$validate();

      if (!this.v$.$error) {
        await axios
          .post(
            "hp/login",

            {
              email: this.email,
              password: this.password,
              remember_me: this.remember_me,
            },
            { headers: { Accept: "application/json" } }
          )
          .then((response) => {
            localStorage.setItem("op_token", response.data.token);
            const userStore = useUserStore();
            userStore.setUser(response.data.user);
            this.processing = false;
            this.$router.push("/hp");
          })
          .catch((ex) => {
            this.processing = false;
            localStorage.removeItem("op_token");
            switch (ex.response.status) {
              case 422:
                this.validationErrors = ex.response.data.errors;
                this.errors_exist = true;
                break;
              case 401:
                this.invalid_credentials = ex.response.data.message;
                this.isLoginInvalid = true;
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
      email: {
        required: helpers.withMessage("Por favor preencha o email", required),
        email: helpers.withMessage("Por favor preencha um email válido", email),
      },
      password: {
        required: helpers.withMessage(
          "Por favor preencha a palavra passe",
          required
        ),
      },
      processing: {},
      remember_me: {},
      errors_exist: {},
      validationErrors: {},
      isLoginInvalid: {},
      invalid_credentials: {},
    };
  },
  components: {
    NavBar,
    Footer,
  },
};
</script>
