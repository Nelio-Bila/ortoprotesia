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
              type="text"
              class="form-control"
              placeholder="Nome"
              v-model="name"
            />
          </div>
          <div class="col">
            <label for="surname">Apelido</label>
            <input
              type="text"
              class="form-control"
              placeholder="Apelido"
              v-model="surname"
            />
          </div>
        </div>
        <div class="form-group mb-3">
          <label for="birthdate">Data de nascimento</label>
          <input
            type="date"
            class="form-control"
            placeholder="Data de nascimento"
            v-model="birthdate"
          />
        </div>
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input
            type="email"
            class="form-control"
            placeholder="Email"
            v-model="email"
          />
        </div>
        <div class="form-group mb-3">
          <label for="password">Palavra passe</label>
          <input
            type="password"
            class="form-control"
            placeholder="Palavra passe"
            v-model="password"
          />
        </div>
        <div class="form-group mb-3">
          <label for="password_confirm">Confirma a palavra passe</label>
          <input
            type="password"
            class="form-control"
            placeholder="Palavra passe"
            v-model="password_confirm"
          />
        </div>
        <div class="form-check mb-3">
          <label for="password_confirm" class="form-check-label"
            >Li e aceito a <a href="#">Politica de privacidade</a> e os
            <a href="#">termos e condiçoes</a></label
          >
          <input
            type="checkbox"
            class="form-check-input"
            v-model="politics_confirm"
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

export default {
  name: "Register",
  data() {
    return {
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
    },
    confirm_politics() {
      this.politics_confirm = !this.politics_confirm;
    },
  },
};
</script>
