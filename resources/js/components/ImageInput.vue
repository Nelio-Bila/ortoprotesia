<template>
  <div>
    <input
      type="file"
      accept="image/*"
      class="hidden"
      ref="file"
      @change="change"
      id="image"
    />
    <div class="relative inline-block rounded-3">
      <img :src="src" alt="" class="h-52 w-52 object-cover rounded-3" />
      <div
        class="
          absolute
          top-0
          h-full
          w-full
          bg-black bg-opacity-25
          flex
          items-center
          justify-center
          rounded-3
        "
      >
        <i
          @click.prevent="browse()"
          class="
            fa-solid fa-camera fa-2xl
            primary-color
            cursor-pointer
            hover:white
            mx-2
          "
        ></i>
        <i
          v-if="file"
          @click.prevent="remove()"
          class="
            fa-solid fa-xmark fa-2xl
            primary-color
            cursor-pointer
            hover:white
            mx-2
          "
        ></i>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: File,
    defaultSrc: String,
  },
  data() {
    return {
      src: this.defaultSrc,
      file: null,
    };
  },
  methods: {
    browse() {
      this.$refs.file.click();
    },
    remove() {
      this.file = null;
      this.src = this.defaultSrc;
      this.$emit("input", this.file);
    },
    change(e) {
      this.file = e.target.files[0];
      this.$emit("input", this.file);
      let reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = (e) => {
        this.src = e.target.result;
      };
    },
  },
};
</script>
