<template>
  <Spinner v-if="loading" />
  <div v-else>
    <NavBar />
    <div class="container align-items-center justify-content-center">
      <div class="row my-2">
        <div class="col-md-7 mx-auto">
          <form @submit.prevent="handleSubmit">
            <h3 class="text-center">Criação de conta</h3>
            <div v-if="errors_exist">
              <div
                v-for="(field, k) in validationErrors"
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

            <div class="row mb-3">
              <div class="col text-center">
                <button class="btn btn-outline-primary">
                  <img
                    src="images/icons/Google.svg"
                    class="mx-2"
                    alt="Google"
                  />
                  Atravês do Google
                </button>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <hr />
              </div>
              OU
              <div class="col">
                <hr />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="name">Nome</label>
                <input
                  @blur="v$.name.$touch"
                  type="text"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.name.$error,
                    'is-valid': !v$.name.$invalid,
                  }"
                  placeholder="Nome"
                  v-model="v$.name.$model"
                />
                <span class="invalid-feedback" v-if="v$.name.$error">
                  {{ v$.name.$errors[0].$message }}
                </span>
              </div>
              <div class="col">
                <label for="surname">Apelido</label>
                <input
                  @blur="v$.surname.$touch"
                  type="text"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.surname.$error,
                    'is-valid': !v$.surname.$invalid,
                  }"
                  placeholder="Apelido"
                  v-model="v$.surname.$model"
                />
                <span class="invalid-feedback" v-if="v$.surname.$error">
                  {{ v$.surname.$errors[0].$message }}
                </span>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="birthdate">Data de nascimento</label>
              <input
                @blur="v$.birthdate.$touch"
                type="date"
                class="form-control"
                :class="{
                  'is-invalid': v$.birthdate.$error,
                  'is-valid': !v$.birthdate.$invalid,
                }"
                placeholder="Data de nascimento"
                v-model="v$.birthdate.$model"
              />
              <span class="invalid-feedback" v-if="v$.birthdate.$error">
                {{ v$.birthdate.$errors[0].$message }}
              </span>
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
                @blur="v$.password.$touch"
                type="password"
                class="form-control"
                :class="{
                  'is-invalid': v$.password.$error,
                  'is-valid': !v$.password.$invalid,
                }"
                placeholder="Palavra passe"
                v-model="v$.password.$model"
              />
              <span class="invalid-feedback" v-if="v$.password.$error">
                {{ v$.password.$errors[0].$message }}
              </span>
            </div>
            <div class="form-group mb-3">
              <label for="password_confirm">Confirma a palavra passe</label>
              <input
                @blur="v$.password_confirm.$touch"
                type="password"
                class="form-control"
                :class="{
                  'is-invalid': v$.password_confirm.$error,
                  'is-valid': !v$.password_confirm.$invalid,
                }"
                placeholder="Confirmação da palavra passe"
                v-model="v$.password_confirm.$model"
              />
              <span class="invalid-feedback" v-if="v$.password_confirm.$error">
                {{ v$.password_confirm.$errors[0].$message }}
              </span>
            </div>
            <div class="form-check mb-3">
              <label for="password_confirm" class="form-check-label"
                >Li e aceito a <a href="#">Politica de privacidade</a> e os
                <a href="#">termos e condições</a></label
              >
              <input
                type="checkbox"
                class="form-check-input"
                v-model="v$.politics_confirm.$model"
                @click="confirm_politics()"
              />
            </div>
            <div class="d-flex justify-content-between">
              <router-link class="" to="login"></router-link>
              <router-link class="" to="login"
                >Já tenho conta, iniciar sessão</router-link
              >
            </div>

            <button
              :disabled="!politics_confirm"
              class="btn btn-primary btn-block btn-lg"
            >
              <i
                v-if="processing"
                class="fa-solid fa-spinner fa-spin-pulse mx-2"
              ></i>
              <span v-if="processing">Processando...</span>

              <i v-if="!processing" class="fa-solid fa-user-plus mx-2"></i>
              <span v-if="!processing">Criar</span>
            </button>
          </form>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
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
  name: "Register",
  data() {
    return {
      v$: useValidate(),
      name: "",
      surname: "",
      birthdate: "",
      email: "",
      password: "",
      password_confirm: "",
      politics_confirm: false,
      processing: false,
      errors_exist: false,
      validationErrors: null,
      loading: true,
    };
  },
  methods: {
    async handleSubmit() {
      this.processing = true;
      this.v$.$validate();
      if (!this.v$.$error) {
        await axios
          .post("register", {
            name: this.name,
            surname: this.surname,
            birthdate: this.birthdate,
            email: this.email,
            password: this.password,
            password_confirm: this.password_confirm,
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
    confirm_politics() {
      this.politics_confirm = !this.politics_confirm;
    },
  },
  validations() {
    return {
      name: {
        required: helpers.withMessage("Por favor preencha o nome", required),
        minLength: helpers.withMessage(
          "Por favor preencha um nome válido",
          minLength(2)
        ),
        minLengthValue: minLength(2),
      },
      surname: {
        required: helpers.withMessage("Por favor preencha o apelido", required),
        minLength: helpers.withMessage(
          "Por favor preencha um apelido válido",
          minLength(2)
        ),
        minLengthValue: minLength(2),
      },
      birthdate: {
        required: helpers.withMessage(
          "Por favor preencha a data de nascimento",
          required
        ),
      },
      email: {
        required: helpers.withMessage("Por favor preencha o email", required),
        email: helpers.withMessage("Por favor preencha um email válido", email),
      },
      password: {
        required: helpers.withMessage(
          "Por favor preencha a palavra passe",
          required
        ),
        minLength: helpers.withMessage(
          "A palavra passe deve ter 6 caracteres no minímo",
          minLength(6)
        ),
        minLengthValue: minLength(6),
      },
      password_confirm: {
        required: helpers.withMessage(
          "Por favor preencha a confirmação da palavra passe",
          required
        ),
        password_confirm: sameAs(this.password),
        password_confirm: helpers.withMessage(
          "A confirmação esta incorrecta",
          sameAs(this.password)
        ),
      },
      politics_confirm: {},
      processing: {},
      errors_exist: {},
      validationErrors: {},
      loading: {},
    };
  },
  mounted() {
    this.loading = false;
  },
  components: { NavBar, Footer },
};
</script>
