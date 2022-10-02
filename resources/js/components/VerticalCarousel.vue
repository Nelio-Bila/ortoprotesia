<template>
  <div class="my-2">
    <div
      id="carouselExampleControls"
      class="carousel slide"
      data-bs-ride="carousel"
    >
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/images/various/hcm.jpg" class="d-block w-100" alt="hcm" />
        </div>
        <div class="carousel-item">
          <img src="/images/various/hcm.jpg" class="d-block w-100" alt="hcm" />
        </div>
        <div class="carousel-item">
          <img src="/images/various/hcm.jpg" class="d-block w-100" alt="hcm" />
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleControls"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.img {
  /* height: 15em; */
  object-fit: cover;
  width: 100%;
  height: 350px;
  min-height: 350px;
}
</style>
