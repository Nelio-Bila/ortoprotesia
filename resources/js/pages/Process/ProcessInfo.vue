<template>
  <div>
    <NavBar />
    <div class="container">
      <h1>Guia sobre marcação de consultas e abertura de processo clinico</h1>

      <div class="text-justify">
        <p>
          Através desta plataforma é possivel marcar consultas de próteses e ou
          ortoteses no Hospital Central de Maputo. Devendo para tal o utente
          criar uma conta e a posterior abrir seu processo, preenchendo os dados
          que lhe forem pedido no formulário de abertura de conta.
        </p>
      </div>
      <div class="m-2">
        <h4>Dados para abertura de conta (* obrigatório)</h4>
        <ul>
          <li>Nome completo*</li>
          <li>Email*</li>
          <li>Palavra passe*</li>
        </ul>
      </div>
      <div class="m-2">
        <h4>Dados para abertura de processo (* obrigatório)</h4>
        <ul>
          <li>Conta no sistema</li>
          <li>Estado civil</li>
          <li>Genêro*</li>
          <li>Raça*</li>
          <li>Telefone*</li>
          <li>Profissão</li>
          <li>Local de trabalho</li>
          <li>Naturalidade*</li>
          <li>Nome do pai</li>
          <li>Nome da mãe</li>
          <li>
            Endereço
            <ul>
              <li>Provincia*</li>
              <li>Distrito*</li>
              <li>Bairro*</li>
            </ul>
          </li>
          <li>
            Bilhete de identificação
            <ul>
              <li>Numero*</li>
              <li>Registo civil*</li>
              <li>Data de emissão*</li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <Footer />
  </div>
</template>


<script setup>
import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";
</script>
