<template>
  <div v-if="errors">
    <div
      v-for="(v, k) in errors"
      :key="k"
      class="
        bg-red-500
        text-white
        rounded
        font-bold
        mb-4
        shadow-lg
        py-2
        px-4
        pr-0
      "
    >
      <p v-for="error in v" :key="error" class="text-sm">
        {{ error }}
      </p>
    </div>
  </div>
  <form class="space-y-6" v-on:submit.prevent="saveCategory">
    <div class="space-y-4 rounded-md shadow-sm">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700"
          >Nome</label
        >
        <div class="mt-1">
          <input
            type="text"
            name="name"
            id="name"
            class="
              block
              mt-1
              w-full
              rounded-md
              border-gray-300
              shadow-sm
              focus:border-indigo-300
              focus:ring
              focus:ring-indigo-200
              focus:ring-opacity-50
            "
            v-model="category.name"
          />
        </div>
      </div>
    </div>

    <button
      type="submit"
      class="
        inline-flex
        items-center
        px-4
        py-2
        text-xs
        font-semibold
        tracking-widest
        text-white
        uppercase
        bg-gray-800
        rounded-md
        border border-transparent
        ring-gray-300
        transition
        duration-150
        ease-in-out
        hover:bg-gray-700
        active:bg-gray-900
        focus:outline-none focus:border-gray-900 focus:ring
        disabled:opacity-25
      "
    >
      Salvar
    </button>
  </form>
</template>

<script>
import { onMounted } from "vue";

import useCategories from "../../../composables/categories";

export default {
  props: {
    id: {
      required: true,
      type: String,
    },
  },
  setup(props) {
    const { errors, category, getCategory, updateCategory } = useCategories();
    onMounted(getCategory(props.id));
    const saveCategory = async () => {
      await updateCategory(props.id);
    };
    return {
      errors,
      category,
      saveCategory,
    };
  },
};
</script>
