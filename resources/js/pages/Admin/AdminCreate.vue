<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="admins" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <div
          class="
            d-flex
            justify-content-between
            flex-wrap flex-md-nowrap
            align-items-center
            pt-3
            pb-2
            mb-3
            border-bottom
          "
        >
          <h1 class="h2">Registro de novo usuário administrador</h1>
        </div>

        <router-link to="/admins" class="btn btn-primary mb-4"
          >Lista de usuários admins</router-link
        >
        <div v-if="errors">
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

        <form @submit.prevent="saveAdmin">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
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
                  v-model="form.name"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.name.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
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
                  v-model="form.surname"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.surname.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
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
                  v-model="form.birthdate"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.birthdate.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input
                  @blur="v$.email.$touch"
                  type="text"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.email.$error,
                    'is-valid': !v$.email.$invalid,
                  }"
                  placeholder="Email"
                  v-model="form.email"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.email.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
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
                  v-model="form.password"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.password.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="password_confirm"
                  >Confirmação da palavra passe</label
                >
                <input
                  @blur="v$.password_confirm.$touch"
                  type="password"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.password_confirm.$error,
                    'is-valid': !v$.password_confirm.$invalid,
                  }"
                  placeholder="Confirmação de palavra passe"
                  v-model="form.password_confirm"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.password_confirm.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
          </div>

          <button class="btn btn-primary tn-block mb-3" :disabled="processing">
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
            <span v-if="processing">Processando...</span>
            <i
              v-if="!processing"
              class="fa-solid fa-arrow-right-to-bracket mx-2"
            ></i>
            <span v-if="!processing">Salvar</span>
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { reactive, computed, ref } from "vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  minLength,
  helpers,
  email,
  sameAs,
} from "@vuelidate/validators";

import useAdmins from "../../composables/admins";
import HPNavBar from "../../components/HPNavBar.vue";
import HPSideBar from "../../components/HPSideBar.vue";

const form = reactive({
  name: "",
  surname: "",
  birthdate: "",
  email: "",
  password: "",
  password_confirm: "",
});

const { processing, errors, storeAdmin } = useAdmins();

const rules = computed(() => ({
  name: {
    required: helpers.withMessage("Por favor preencha o nome", required),
    minLength: helpers.withMessage(
      "Por favor preencha um nome válido",
      minLength(2)
    ),
  },
  surname: {
    required: helpers.withMessage("Por favor preencha o apelido", required),
    minLength: helpers.withMessage(
      "Por favor preencha um apelido válido",
      minLength(2)
    ),
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
  },
  password_confirm: {
    required: helpers.withMessage(
      "Por favor preencha a confirmação da palavra passe",
      required
    ),
    password_confirm: sameAs(form.password),
    password_confirm: helpers.withMessage(
      "A confirmação esta incorrecta",
      sameAs(form.password)
    ),
  },
}));

const v$ = useVuelidate(rules, form);

const saveAdmin = async () => {
  v$._value.$validate();
  if (!v$._value.$invalid) {
    await storeAdmin({ ...form });
  } else {
    processing.value = false;
  }
};
</script>
