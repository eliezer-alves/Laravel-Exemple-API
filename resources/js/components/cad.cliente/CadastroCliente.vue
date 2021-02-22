<template>
  <!-- component -->
  <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 px-5">
    <div class="mx-auto lg:mt-32 md:mt-32 sm:mt-10 mt-10 col-span-1">
      <img src="/images/logoAgilVertical.png" class="w-60" alt="" />
      <h1
        class="mt-4 ml-5 text-3xl text-gradient bg-gradient-to-r from-gray-300 via-white to-gray-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600"
      >
        Capital de Giro
      </h1>
    </div>
    <div class="lg:mr-32 md:mr-32 sm:mr-10 mx-1 mt-4 col-span-2 rounded-md p-2">
      <h1
        class="mt-4 text-center text-3xl text-gradient bg-gradient-to-r from-gray-300 via-white to-gray-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600"
      >
        Formulário de Cadastro
      </h1>
      <form action="/solicitar" class="w-full">
        <div class="grid">
          <div class="py-1 col-span-1">
            <span class="px-1 text-sm text-gray-300">CNPJ</span>
            <input
              id="cnpj"
              name="cnpj"
              placeholder="00.000.000/0000-00"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1 col-span-1">
            <span class="px-1 text-sm text-gray-300">Insc. Estadual</span>
            <input
              id="inscricao_estadual"
              name="inscricao_estadual"
              placeholder="00.000.0000-0"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1 col-span-2">
            <span class="px-1 text-sm text-gray-300">Atividade Comercial</span>
            <select
              id="id_atividade_comercial"
              name="id_atividade_comercial"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            >
              <option>--</option>
              <option
                v-for="atividade in atividades"
                :key="atividade.id_atividade_comercial"
                value="atividade.id_atividade_comercial"
              >
                {{ atividade.descricao }}
              </option>
            </select>
          </div>
          <div class="py-1 col-span-2">
            <span class="px-1 text-sm text-gray-300">Nome Fantasia</span>
            <input
              id="nome_fantasia"
              name="nome_fantasia"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1 col-span-2">
            <span class="px-1 text-sm text-gray-300">Razão Social</span>
            <input
              id="razao_social"
              name="razao_social"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">E-mail</span>
            <input
              id="email"
              name="email"
              placeholder="mail@mail.com"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Confirmar E-mail</span>
            <input
              id="email_confirmation"
              name="email_confirmation"
              placeholder="mail@mail.com"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Senha</span>
            <input
              id="senha"
              name="senha"
              type="password"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Confirmar Senha</span>
            <input
              id="senha_confirmation"
              name="senha_confirmation"
              type="password"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Celular</span>
            <input
              id="celular"
              name="celular"
              placeholder="(00) 00000-0000"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">CEP</span>
            <input
              id="cep"
              name="cep"
              placeholder="37750-000"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">UF</span>
            <select
              id="uf"
              name="uf"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            >
              <option value="MG">Minas Gerais</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="SP">São Paulo</option>
            </select>
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Cidade</span>
            <input
              id="cidade"
              name="cidade"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Bairro</span>
            <input
              id="bairro"
              name="bairro"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Tipo de Logradouro</span>
            <select
              id="id_tipo_logradouro"
              name="id_tipo_logradouro"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            >
              <option value="avenida">Avenida</option>
              <option value="praca">Praça</option>
              <option value="rua">Rua</option>
            </select>
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Logradouro</span>
            <input
              id="logradouro"
              name="logradouro"
              type="text"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
          <div class="py-1">
            <span class="px-1 text-sm text-gray-300">Número</span>
            <input
              id="numero"
              name="numero"
              type="number"
              class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            />
          </div>
        </div>
        <div class="flex flex-wrap justify-end">
          <button
            class="mt-2 text-center w-40 text-green-900 text-lg font-bold bg-gradient-to-r from-green-600 to-yellow-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600 p-3 rounded-md hover:bg-black"
          >
            Cadastrar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  beforeCreate: function () {
    document.body.className = "login";
  },
  async mounted() {
    await this.$store.dispatch("fetchAtividades");
  },
  computed: {
    ...mapGetters(["atividades"]),
  },
};
</script>
<style>
.login {
  -webkit-font-smoothing: antialiased;
  background-image: url("/images/texturaBackgroundAgil.png");
  background-color: #30615f;
  background-size: 900px;
}
</style>
