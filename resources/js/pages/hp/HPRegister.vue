<template>
  <div>
    <NavBar />
    <div class="row my-2">
      <div class="col-md-7 mx-auto">
        <form @submit.prevent="handleSubmit">
          <h3 class="text-center">Criação de conta</h3>
          <h3 class="text-center">Professional de Saúde</h3>
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

          <div class="row mb-3">
            <div class="col">
              <label for="name">Carreira</label>
              <input
                @blur="v$.carrier.$touch"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': v$.carrier.$error,
                  'is-valid': !v$.carrier.$invalid,
                }"
                placeholder="Ex.: Técnico de saúde"
                v-model="v$.carrier.$model"
              />
              <span class="invalid-feedback" v-if="v$.carrier.$error">
                {{ v$.carrier.$errors[0].$message }}
              </span>
            </div>
            <div class="col">
              <label for="surname">Categoria</label>
              <input
                @blur="v$.category.$touch"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': v$.category.$error,
                  'is-valid': !v$.category.$invalid,
                }"
                placeholder="Ex.: Técnico de saúde"
                v-model="v$.category.$model"
              />
              <span class="invalid-feedback" v-if="v$.category.$error">
                {{ v$.category.$errors[0].$message }}
              </span>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="name">Instituição</label>
              <input
                @blur="v$.institution.$touch"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': v$.institution.$error,
                  'is-valid': !v$.institution.$invalid,
                }"
                placeholder="Ex.: Hospital Central de Maputo, Hospital Central da Beira,..."
                v-model="v$.institution.$model"
              />
              <span class="invalid-feedback" v-if="v$.institution.$error">
                {{ v$.institution.$errors[0].$message }}
              </span>
            </div>
            <div class="col">
              <label for="surname">Departamento</label>
              <input
                @blur="v$.department.$touch"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': v$.department.$error,
                  'is-valid': !v$.department.$invalid,
                }"
                placeholder="Ex.: Medicina Fisica e Reabilitação"
                v-model="v$.department.$model"
              />
              <span class="invalid-feedback" v-if="v$.department.$error">
                {{ v$.department.$errors[0].$message }}
              </span>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
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
            <div class="col">
              <label for="birthdate">Data de inicio das funções</label>
              <input
                @blur="v$.starting_work_date.$touch"
                type="date"
                class="form-control"
                :class="{
                  'is-invalid': v$.starting_work_date.$error,
                  'is-valid': !v$.starting_work_date.$invalid,
                }"
                placeholder="Data de inicio de funções"
                v-model="v$.starting_work_date.$model"
              />
              <span
                class="invalid-feedback"
                v-if="v$.starting_work_date.$error"
              >
                {{ v$.starting_work_date.$errors[0].$message }}
              </span>
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
              <a href="#">termos e condiçoes de uso</a></label
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
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
            <span v-if="processing">Processando...</span>

            <i v-if="!processing" class="fa-solid fa-user-plus mx-2"></i>
            Criar
          </button>
        </form>
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
  maxValue,
  minValue,
} from "@vuelidate/validators";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

export default {
  name: "HPRegister",
  data() {
    return {
      v$: useValidate(),
      name: "",
      surname: "",
      birthdate: "",
      carrier: "",
      category: "",
      institution: "",
      department: "",
      starting_work_date: "",
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
          .post("hp/register", {
            name: this.name,
            surname: this.surname,
            birthdate: this.birthdate,
            carrier: this.carrier,
            category: this.category,
            institution: this.institution,
            department: this.department,
            starting_work_date: this.starting_work_date,
            email: this.email,
            password: this.password,
            password_confirm: this.password_confirm,
          })
          .then((response) => {
            this.processing = false;
            this.$router.push("/hp/login");
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
    isOver18(dateOfBirth) {
      // find the date 18 years ago
      const date18YrsAgo = new Date();
      date18YrsAgo.setFullYear(date18YrsAgo.getFullYear() - 18);
      // check if the date of birth is before that date
      return dateOfBirth <= date18YrsAgo;
    },
  },
  validations() {
    return {
      name: {
        required: helpers.withMessage("Por favor preencha o nome", required),
        minLength: helpers.withMessage(
          "Por favor preencha um nome válido",
          minLength(2)
        )
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
        // maxValue: maxValue(new Date().toISOString()),
        // maxValue: (value) => value > new Date().toISOString(),
      },
      carrier: {
        required: helpers.withMessage(
          "Por favor preencha a designação da sua carreira",
          required
        ),
      },
      category: {
        required: helpers.withMessage(
          "Por favor preencha a sua categoria",
          required
        ),
      },
      institution: {
        required: helpers.withMessage(
          "Por favor preencha a instituição em que estas afecto(a)",
          required
        ),
      },
      department: {
        required: helpers.withMessage(
          "Por favor preencha o departamento em que estas afecto(a)",
          required
        ),
      },
      starting_work_date: {
        // maxValue: helpers.withMessage(
        //   "Por favor preencha uma data válida (anterior ao presente)",
        //   maxValue(new Date())
        // ),
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
    };
  },
  components: {
    NavBar,
    Footer,
  },
};
</script>
