<template>
  <div>
    <NavBar />
    <!-- <div class="container">
      <h1 class="text-center">
        Centro Ortopédico do Hospital Central de Maputo
      </h1>
      <p>
        O Centro Ortopédico do Hospital Central de Maputo localiza-se na Avenida
        Eduardo Mondlane 1653, Maputo, nas instalações do Hospital Central de
        Maputo, tem como missão oferecer serviços de reabilitação a pacientes
        portadores de deficiência física através de aparelhos ortopédicos como
        próteses, órteses, cadeiras de rodas, andarilhos, canadianas muletas,
        canadianas axilares, bengalas e mais.
      </p>

      <h2 class="text-center">Organograma</h2>
      <img
        class="rounded mx-auto d-block my-5"
        src="/images/various/org.png"
        alt="fluxo de atendimento"
      />
      <h2 class="text-center mb-5">Fluxo de atendimento</h2>
      <img
        class="rounded mx-auto d-block"
        src="/images/various/fluxo.png"
        alt="fluxo de atendimento"
      />
    </div> -->

    <!-- <div class="container"> -->
    <div class="card">
      <div class="row g-0">
        <div class="col-sm-4 position-relative">
          <img
            src="https://via.placeholder.com/600"
            class="card-img fit-cover w-100 h-100"
            alt="..."
          />
        </div>

        <div class="col-sm-8">
          <div class="card-body">
            <h5 class="card-title">
              <a class="link-dark text-decoration-none" href="#" target="_blank"
                >Card Title</a
              >
            </h5>

            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <span class="badge rounded-pill bg-dark">Tag1</span>
          </div>

          <div class="card-footer text-end text-muted">Last updated today.</div>
        </div>
      </div>
    </div>
    <!-- </div> -->
    <Footer />
  </div>
</template>

<script setup>
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
</script>
