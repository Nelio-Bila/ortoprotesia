
<template>
  <!-- Footer -->
  <footer class="text-center text-lg-start text-muted">
    <!-- Section: Social media -->
    <!-- <section
      class="
        d-flex
        justify-content-center justify-content-lg-between
        p-4
        border-bottom
      "
    > -->
    <!-- Left -->
    <!-- <div class="me-5 d-none d-lg-block">
        <span>Siga nos nas redes sociais:</span>
      </div> -->
    <!-- Left -->

    <!-- Right -->
    <!-- <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div> -->
    <!-- Right -->
    <!-- </section> -->
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">Ortoprotesia</h6>
            <p>
              Nesta plataforma podes obter várias informações relacionadas com a
              Ortoprotesia em Moçambique e a Medicina Fisica e Reabilitação no
              geral.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Informações legais</h6>
            <p>
              <router-link to="/privacy-policy" class="text-reset"
                >Política de privacidade</router-link
              >
            </p>
            <p>
              <router-link to="/terms-and-conditions" class="text-reset"
                >Termos e condições de uso</router-link
              >
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Links uteis</h6>

            <p>
              <router-link to="/hp" class="text-reset"
                >Profissional de Saúde</router-link
              >
            </p>
            <p>
              <router-link to="/admin/home" class="text-reset"
                >Administração</router-link
              >
            </p>
            <p>
              <a href="#!" class="text-reset">Reportar erro</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contactos e endereço</h6>
            <p>
              <i class="fas fa-home me-3"></i>Agostinho Neto, n° 164, Maputo
            </p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              centroortopedicohcm@gmail.com
            </p>
            <!-- <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> -->
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05)">
      © {{ new Date().getFullYear() }} Todos direitos reservados:
      <router-link class="text-reset fw-bold" to="/">Ortoprotesia</router-link>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</template>

<script>
export default {
  name: "Footer",
};
</script>

