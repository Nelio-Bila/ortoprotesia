<template>
  <Spinner v-if="loading" />
  <div v-else>
    <NavBar />
    <div class="row my-2">
      <div class="col-md-5 mx-auto">
        <form @submit.prevent="handleLogin" class="mt-5">
          <h3 class="text-center">Inicio de sessão</h3>
          <div class="row mb-3">
            <div class="col text-center">
              <button class="btn btn-outline-primary">
                <img src="images/icons/Google.svg" class="mx-2" alt="Google" />
                Atravês do Google
              </button>
            </div>
          </div>
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
          <div class="row mb-3">
            <div class="col">
              <hr />
            </div>
            OU
            <div class="col">
              <hr />
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
              v-model="form.email"
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
              v-model="form.password"
            />
            <span class="invalid-feedback" v-if="v$.password.$error">
              {{ v$.password.$errors[0].$message }}
            </span>
          </div>
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              v-model="form.remember_me"
            />
            <label class="form-check-label" for="flexCheckDefault">
              Manter me logado
            </label>
          </div>

          <button class="btn btn-primary tn-block mb-3" :disabled="processing">
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
            <span v-if="processing">Entrando...</span>
            <i
              v-if="!processing"
              class="fa-solid fa-arrow-right-to-bracket mx-2"
            ></i>
            <span v-if="!processing">Entrar</span>
          </button>
          <br />
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

<script setup>
import { reactive, computed, onMounted, ref } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, email, helpers } from "@vuelidate/validators";
import { useRouter } from "vue-router";

import Spinner from "../../components/Spinner.vue";
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import useAuth from "../../composables/auth";

const router = useRouter();

const loading = ref(true);
onMounted(() => {
  loading.value = false;
});

const form = reactive({
  email: "",
  password: "",
  remember_me: false,
});

const {
  login,
  errors_exist,
  errors,
  processing,
  validationErrors,
  invalid_credentials,
  isLoginInvalid,
} = useAuth();

const rules = computed(() => ({
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
  remember_me: {},
}));

const v$ = useVuelidate(rules, form);

const handleLogin = async () => {
  v$._value.$validate();
  if (!v$._value.$invalid) {
    await login({ ...form });
  } else {
    processing.value = false;
  }
};
</script>
