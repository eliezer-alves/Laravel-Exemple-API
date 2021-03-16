<template>
  <cadastro-cliente>
    <div class="py-1">
      <span class="px-1 text-sm font-bold text-white">Celular</span>
      <input
        id="celular"
        name="celular"
        placeholder="(00) 00000-0000"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-mask="['(##) ####-####', '(##) #####-####']"
        :value="$v.cliente.celular.$model"
        @input="setCelular($event.target.value)"
      />
      <div
        class="text-red-600"
        v-if="$v.cliente.celular.$dirty && !$v.cliente.celular.required"
      >
        Telefone é obrigatório.
      </div>
      <div
        class="text-red-600"
        v-if="$v.cliente.celular.$dirty && !$v.cliente.celular.minLength"
      >
        Telefone inválido
      </div>
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="celular in errors.celular"
        :key="celular"
        >{{ celular }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm font-bold text-white">E-mail</span>
      <input
        id="email"
        name="email"
        placeholder="mail@mail.com"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model.trim="$v.cliente.email.$model"
      />
      <div
        class="text-red-600"
        v-if="$v.cliente.email.$dirty && !$v.cliente.email.required"
      >
        E-mail é obrigatório.
      </div>
      <div
        class="text-red-600"
        v-if="$v.cliente.email.$dirty && !$v.cliente.email.email"
      >
        E-mail inválido.
      </div>
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="email in errors.email"
        :key="email"
        >{{ email }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm font-bold text-white">Confirmar E-mail</span>
      <input
        id="email_confirmation"
        name="email_confirmation"
        placeholder="mail@mail.com"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="$v.cliente.email_confirmation.$model"
      />
      <div
        class="text-red-600"
        v-if="
          $v.cliente.email_confirmation.$dirty &&
          !$v.cliente.email_confirmation.required
        "
      >
        E-mail é obrigatório.
      </div>
      <div
        class="text-red-600"
        v-if="
          $v.cliente.email_confirmation.$dirty &&
          !$v.cliente.email_confirmation.email
        "
      >
        E-mail inválido.
      </div>
      <div
        class="text-red-600"
        v-if="
          $v.cliente.email_confirmation.$dirty &&
          !$v.cliente.email_confirmation.sameAsEmail
        "
      >
        E-mails devem ser idênticos
      </div>
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="email in errors.email"
        :key="email"
        >{{ email }}</span
      >
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="email_confirmation in errors.email_confirmation"
        :key="email_confirmation"
        >{{ email_confirmation }}
      </span>
    </div>
    <div class="py-1">
      <span class="px-1 text-sm font-bold text-white">Senha</span>
      <input
        id="senha"
        name="senha"
        type="password"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="$v.cliente.senha.$model"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="senha in errors.senha"
        :key="senha"
      >
        {{ senha }}
      </span>
      <div
        class="text-red-600"
        v-if="$v.cliente.senha.$dirty && !$v.cliente.senha.required"
      >
        Senha é obrigatório.
      </div>
    </div>
    <div class="py-1">
      <span class="px-1 text-sm font-bold text-white">Confirmar Senha</span>
      <input
        id="senha_confirmation"
        name="senha_confirmation"
        type="password"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="$v.cliente.senha_confirmation.$model"
      />
      <div
        class="text-red-600"
        v-if="
          $v.cliente.senha_confirmation.$dirty &&
          !$v.cliente.senha_confirmation.required
        "
      >
        Senha é obrigatório.
      </div>
      <div
        class="text-red-600"
        v-if="
          $v.cliente.senha_confirmation.$dirty &&
          !$v.cliente.senha_confirmation.sameAsSenha
        "
      >
        Senhas devem ser idênticas.
      </div>
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="senha_confirmation in errors.senha_confirmation"
        :key="senha_confirmation"
      >
        {{ senha_confirmation }}
      </span>
      <div class="flex justify-between">
        <router-link :to="{ name: 'cadastro-cliente' }">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="font-bold text-white hover:text-teal-600 w-12"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 16l-4-4m0 0l4-4m-4 4h18"
            />
          </svg>
        </router-link>

        <svg
          @click="validateFields"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="font-bold text-white hover:text-teal-600 w-12"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 8l4 4m0 0l-4 4m4-4H3"
          />
        </svg>
      </div>
    </div>
  </cadastro-cliente>
</template>
<script>
import CadastroCliente from "../CadastroCliente.vue";
import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
  components: {
    CadastroCliente,
  },
  computed: {
    ...mapGetters(["cliente", "errors"]),
    ...mapFields(["cliente", "errors"]),
  },
  validations: {
    cliente: {
      celular: { required, minLength: minLength(10) },
      email: { required, email },
      email_confirmation: { required, email, sameAsEmail: sameAs("email") },
      senha: { required },
      senha_confirmation: { required, sameAsSenha: sameAs("senha") },
    },
  },
  methods: {
    setCelular(value) {
      value = value.replace(/[^\d]+/g, "");
      this.cliente.celular = value;
      this.$v.cliente.celular.$touch();
    },
    validateFields() {
      if (!this.$v.$invalid) {
        this.$router.push("cadastro-cliente-3");
      }
      this.$v.$touch();
    },
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
