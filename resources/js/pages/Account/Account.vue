<template>
  <div>
    <NavBar />
    <div class="container align-items-center justify-content-center">
      <div class="row my-2">
        <div class="col-md-3 vertical-center">
          <div class="btn-group-vertical w-100 my-2">
            <button class="btn btn-primary block">Dados pessoais</button>
            <button class="btn btn-outline-secondary block">Segurança</button>
            <button class="btn btn-outline-secondary block">Privacidade</button>
            <button class="btn btn-outline-secondary block">Conta</button>
          </div>
        </div>
        <div class="col-md-7 mx-auto">
          <form @submit.prevent="handleSubmit">
            <h3 class="text-center">Dados pessoais</h3>
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

            <div class="row mb-3 text-center">
              <avatar-input
                v-model="form.avatar"
                default-src="/storage/profile_imgs/avatar.png"
              ></avatar-input>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="name">Nome</label>

                <div class="input-group">
                  <input
                    :disabled="!editName"
                    type="text"
                    class="form-control"
                    placeholder="Nome"
                    v-model="form.name"
                    aria-label="Search"
                    aria-describedby="basic-addon1"
                    :class="{
                      'is-invalid': v$.name.$error,
                      'is-valid': !v$.name.$invalid,
                    }"
                    @blur="v$.name.$touch"
                  />
                  <button
                    @click="editName = !editName"
                    class="input-group-text"
                    type="button"
                  >
                    <i
                      @click="v$.name.$touch"
                      v-if="editName"
                      class="
                        fa-solid fa-floppy-disk
                        cursor-pointer
                        text-primary
                      "
                    ></i>
                    <i
                      v-if="!editName"
                      class="fa-solid fa-pencil cursor-pointer text-primary"
                    ></i>
                  </button>
                </div>

                <span class="invalid-feedback" v-if="v$.name.$error">
                  {{ v$.name.$errors[0].$message }}
                </span>
              </div>

              <div class="col">
                <label for="surname">Apelido</label>
                <div class="input-group">
                  <input
                    @blur="v$.surname.$touch"
                    :disabled="!editSurname"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.surname.$error,
                      'is-valid': !v$.surname.$invalid,
                    }"
                    placeholder="Apelido"
                    v-model="form.surname"
                  />
                  <button
                    @click="editSurname = !editSurname"
                    class="input-group-text"
                    type="button"
                  >
                    <i
                      @click="v$.surname.$touch"
                      v-if="editSurname"
                      class="
                        fa-solid fa-floppy-disk
                        cursor-pointer
                        text-primary
                      "
                    ></i>
                    <i
                      v-if="!editSurname"
                      class="fa-solid fa-pencil cursor-pointer text-primary"
                    ></i>
                  </button>
                </div>
                <span class="invalid-feedback" v-if="v$.surname.$error">
                  {{ v$.surname.$errors[0].$message }}
                </span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="birthdate">Data de nascimento</label>
                <div class="input-group">
                  <input
                    @blur="v$.birthdate.$touch"
                    :disabled="!editBirthdate"
                    type="date"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.birthdate.$error,
                      'is-valid': !v$.birthdate.$invalid,
                    }"
                    placeholder="Data de nascimento"
                    v-model="form.birthdate"
                  />
                  <button
                    @click="editBirthdate = !editBirthdate"
                    class="input-group-text"
                    type="button"
                  >
                    <i
                      @click="v$.birthdate.$touch"
                      v-if="editBirthdate"
                      class="
                        fa-solid fa-floppy-disk
                        cursor-pointer
                        text-primary
                      "
                    ></i>
                    <i
                      v-if="!editBirthdate"
                      class="fa-solid fa-pencil cursor-pointer text-primary"
                    ></i>
                  </button>
                </div>
                <span class="invalid-feedback" v-if="v$.birthdate.$error">
                  {{ v$.birthdate.$errors[0].$message }}
                </span>
              </div>
              <div class="col mb-3">
                <label for="email">Email</label>
                <input
                  @blur="v$.email.$touch"
                  disabled="editEmail"
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
            </div>

            <button class="btn btn-primary btn-block btn-lg">
              <i
                v-if="processing"
                class="fa-solid fa-spinner fa-spin-pulse mx-2"
              ></i>
              <span v-if="processing">Processando...</span>

              <i v-if="!processing" class="fa-solid fa-user-plus mx-2"></i>
              Salvar alterações
            </button>
          </form>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { useUserStore } from "../../stores/UserStore";
import { onMounted, ref, reactive, computed } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, email, helpers, minLength } from "@vuelidate/validators";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
import AvatarInput from "../../components/AvatarInput.vue";

import useUsers from "../../composables/users";

const userStore = useUserStore();
const { user, getUser, updateUser, processing } = useUsers();

onMounted(() => {
  form.avatar = userStore.user.avatar;
  form.name = userStore.user.name;
  form.surname = userStore.user.surname;
  form.birthdate = userStore.user.birthdate;
  form.email = userStore.user.email;
});

const editName = ref(false);
const editSurname = ref(false);
const editBirthdate = ref(false);
const editEmail = ref(false);

const form = reactive({
  avatar: "",
  name: "",
  surname: "",
  birthdate: "",
  email: "",
});

const rules = computed(() => ({
  avatar: {},
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
}));

const v$ = useVuelidate(rules, form);

const handleSubmit = async () => {
  v$._value.$validate();
  if (!v$._value.$invalid) {
    await updateUser({ ...form });
  } else {
    processing.value = false;
  }
};
</script>
