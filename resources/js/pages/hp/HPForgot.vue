<template>
  <div>
    <NavBar />
    <div class="row">
      <div class="col-md-5 mx-auto">
        <form @submit.prevent="handleSubmit" class="mt-5">
          <h3 class="text-center">Restauração da palavra passe</h3>

          <p>
            Submeta o email da sua conta, que enviaremos um link para
            restauração da palavra passe
          </p>

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
            <span v-if="!processing">Enviar</span></button
          ><br />
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

export default {
  name: "HPForgot",
  data() {
    return {
      v$: useValidate(),
      email: "",
      processing: false,
      errors_exist: false,
      validationErrors: [],
    };
  },
  methods: {
    async handleSubmit() {
      this.processing = true;
      this.v$.$validate();

      if (!this.v$.$error) {
        await axios
          .post(
            "forgot",
            {
              email: this.email,
            },
            { headers: { Accept: "application/json" } }
          )
          .then((response) => {
            this.processing = false;
            this.$router.push("/login");
          })
          .catch((ex) => {
            this.processing = false;
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
      processing: {},
      errors_exist: {},
      validationErrors: {},
    };
  },
};
</script>

<style>
</style>
