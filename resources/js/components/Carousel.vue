<template>
  <div class="my-2 col">
    <!-- <h1 class="text-center my-2">Noticias</h1> -->

    <div
      id="carouselExampleCaptions"
      class="carousel slide"
      data-bs-ride="carousel"
    >
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner cursor-pointer">
        <router-link to="/news" class="carousel-item active">
          <img
            :src="'/images/various/hcm.jpg'"
            class="d-block w-100 img"
            alt="Outra"
          />
          <div class="carousel-caption d-none d-md-block">
            <h5>Conheça o Centro Ortopédico do HCM</h5>
            <p>
              Saiba o que é e como funciona esse sector do Hospital Central de
              Maputo.
            </p>
          </div>
        </router-link>
        <router-link to="/ortoprotesia" class="carousel-item">
          <img
            :src="'/images/various/hcm.jpg'"
            class="d-block w-100 img"
            alt="Terceira"
          />
          <div class="carousel-caption d-none d-md-block">
            <h5>O que é Ortoprotesia</h5>
            <p>Saiba o que é e o que trata esta area da Saúde.</p>
          </div>
        </router-link>
        <router-link to="/guide" class="carousel-item">
          <img
            :src="'/images/various/hcm.jpg'"
            class="d-block w-100 img"
            alt="Primeira foto"
          />
          <div class="carousel-caption d-none d-md-block">
            <h5>Como usar esta plataforma</h5>
            <p>
              Saiba como usar e tirar máximo proveito desta plataforma, como
              utente, acompanhante, profissinal ou entusiasta.
            </p>
          </div>
        </router-link>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Proxima</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Carousel",
};
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
