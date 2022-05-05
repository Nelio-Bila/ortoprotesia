<template>
  <div class="row">
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
          <div class="col">
            <label for="name">Nome</label>
            <input
              @blur="v$.name.$touch"
              type="text"
              class="form-control"
              :class="v$.name.$error ? 'is-invalid' : ''"
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
              :class="v$.surname.$error ? 'is-invalid' : ''"
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
            :class="v$.birthdate.$error ? 'is-invalid' : ''"
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
            :class="v$.email.$error ? 'is-invalid' : ''"
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
            :class="v$.password.$error ? 'is-invalid' : ''"
            placeholder="Palavra passe"
            v-model="v$.password.$model"
          />
          <span class="invalid-feedback" v-if="v$.password.$error">
            {{ v$.email.$errors[0].$message }}
          </span>
        </div>
        <div class="form-group mb-3">
          <label for="password_confirm">Confirma a palavra passe</label>
          <input
            @blur="v$.password_confirm.$touch"
            type="password"
            class="form-control"
            :class="v$.password_confirm.$error ? 'is-invalid' : ''"
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
            <a href="#">termos e condiçoes</a></label
          >
          <input
            type="checkbox"
            class="form-check-input"
            v-model="v$.politics_confirm.$model"
            @click="confirm_politics()"
          />
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
          Criar
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import useValidate from "@vuelidate/core";
import { required, email, sameAs, helpers } from "@vuelidate/validators";

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
      },
      surname: {
        required: helpers.withMessage("Por favor preencha o apelido", required),
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
      },
      password_confirm: sameAs("password"),
      politics_confirm: {},
      processing: {},
      errors_exist: {},
      validationErrors: {},
    };
  },
};
</script>
