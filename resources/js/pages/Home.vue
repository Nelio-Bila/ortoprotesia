<template>
  <router-view :key="route.fullPath" v-slot="{ Component }">
    <transition
      enter-active-class="animate__animated animate__fadeInLeft"
      leave-active-class="animate__animated animate__fadeOutLeft"
      name="fade"
      mode="out-in"
    >
      <component :is="Component" />
    </transition>
  </router-view>
</template>

<script setup>
import { watch } from "vue";
import { useRoute } from "vue-router";
import { useOnline } from "@vueuse/core";
import { useToast } from "vue-toastification";

const online = useOnline();

const route = useRoute();

const toast = useToast();

watch(online, async (off, on) => {
  if (!off) {
    toast.error("Sem conexão a internet", {
      position: "bottom-left",
      timeout: 2000,
      hideProgressBar: true,
      closeButton: "button",
      rtl: false,
    });
  } else {
    toast.success("Conexão restaurada", {
      position: "bottom-left",
      timeout: false,
      hideProgressBar: true,
      closeButton: "button",
      rtl: false,
    });
  }
});
</script>

<style>
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-out;
}
</style>
