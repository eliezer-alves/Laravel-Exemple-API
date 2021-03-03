<template>
  <solicitacao>
    <div class="p-4 h-6">
      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados Representante Legal
        </div>

        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_representante">Nome</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_representante"
                placeholder="Nome do Representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                :value="$v.nome_representante.$model"
                @input="setNomeRepresentante($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.nome_representante.$dirty && !$v.nome_representante.required
              "
            >
              Nome Representante é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cpf_representante">CPF</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cpf_representante"
                placeholder="###.###.###-##"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-mask="'###.###.###-##'"
                :value="$v.cpf_representante.$model"
                @input="setCpfRepresentante($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.cpf_representante.$dirty && !$v.cpf_representante.required
              "
            >
              CPF válido é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="rg_representante">RG</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="rg_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                :value="$v.rg_representante.$model"
                @input="setRgRepresentante($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.rg_representante.$dirty && !$v.rg_representante.required"
            >
              RG é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="uf_rg_representante">UF do RG</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="uf_rg_representante"
                name="uf_rg_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.uf_rg_representante.$model"
                @change="setUfRgRepresentante($event.target.value)"
              >
                <option value="">--</option>
                <option :value="'SP'">MINAS GERAIS</option>
                <option :value="'MG'">SÃO PAULO</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.uf_rg_representante.$dirty &&
                !$v.uf_rg_representante.required
              "
            >
              UF do RG é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="sexo_representante">Sexo</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="sexo_representante"
                name="sexo_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.sexo_representante.$model"
                @change="setSexoRepresentante($event.target.value)"
              >
                <option value="">--</option>
                <option :value="'M'">Masculino</option>
                <option :value="'F'">Feminino</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.sexo_representante.$dirty && !$v.sexo_representante.required
              "
            >
              Sexo é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="profissao_representante">Profissão</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="profissao_representante"
                name="profissao_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.profissao_representante.$model"
                @change="setProfissaoRepresentante($event.target.value)"
              >
                <option value="">--</option>
                <option :value="'0007'">Aposentado</option>
                <option :value="'0001'">Assalariado</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.profissao_representante.$dirty &&
                !$v.profissao_representante.required
              "
            >
              Profissão é obrigatória
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="estado_civil_representante">Estado Civil</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="estado_civil_representante"
                name="estado_civil_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.estado_civil_representante.$model"
                @change="setEstadoCivilRepresentante($event.target.value)"
              >
                <option value="">--</option>
                <option :value="'S'">SOLTEIRO</option>
                <option :value="'C'">CASADO</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.estado_civil_representante.$dirty &&
                !$v.estado_civil_representante.required
              "
            >
              Estado Civil é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_mae_representante">Nome da Mãe</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_mae_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                :value="$v.nome_mae_representante.$model"
                @input="setNomeMaeRepresentante($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.nome_mae_representante.$dirty &&
                !$v.nome_mae_representante.required
              "
            >
              Nome da Mãe é obrigatório
            </div>
          </div>
        </div>

        <div class="my-2">
          <div
            class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm"
          >
            Endereço/Contato
          </div>
          <div class="grid lg:grid-cols-12 md:grid-cols-12">
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="id_tipo_logradouro_representante"
                  >Tipo Logradouro</label
                >
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <select
                  id="id_tipo_logradouro_representante"
                  name="id_tipo_logradouro_representante"
                  class="p-1 px-2 outline-none w-full text-gray-800"
                  :value="$v.id_tipo_logradouro_representante.$model"
                  @change="
                    setIdTipoLogradouroRepresentante($event.target.value)
                  "
                >
                  <option value="">--</option>
                  <option :value="1">RUA</option>
                  <option :value="2">AVENIDA</option>
                  <option :value="3">PRACA</option>
                </select>
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.id_tipo_logradouro_representante.$dirty &&
                  !$v.id_tipo_logradouro_representante.required
                "
              >
                Tipo do Logradouro é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="logradouro_representante">Logradouro</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="logradouro_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  :value="$v.logradouro_representante.$model"
                  @input="setLogradouroRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.logradouro_representante.$dirty &&
                  !$v.logradouro_representante.required
                "
              >
                Logradouro é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="numero_representante">Número</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="numero_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  :value="$v.numero_representante.$model"
                  @input="setNumeroRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.numero_representante.$dirty &&
                  !$v.numero_representante.required
                "
              >
                Número é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="complemento_representante">Complemento</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="complemento_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  :value="$v.complemento_representante.$model"
                  @blur="setComplementoRepresentante($event.target.value)"
                />
              </div>
            </div>
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="cep_representante">CEP</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="cep_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  v-mask="'#####-###'"
                  :value="$v.cep_representante.$model"
                  @blur="setCepRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.cep_representante.$dirty && !$v.cep_representante.required
                "
              >
                Digite um CEP válido
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.cep_representante.$dirty && !$v.cep_representante.minLength
                "
              >
                CEP inválido
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="bairro_representante">Bairro</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="bairro_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  :value="$v.bairro_representante.$model"
                  @input="setBairroRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.bairro_representante.$dirty &&
                  !$v.bairro_representante.required
                "
              >
                Bairro é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="cidade_representante">Cidade</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="cidade_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  :value="$v.cidade_representante.$model"
                  @input="setCidadeRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.cidade_representante.$dirty &&
                  !$v.cidade_representante.required
                "
              >
                Cidade é obrigatória
              </div>
            </div>
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="uf_representante">UF</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <select
                  id="uf_representante"
                  name="uf_representante"
                  class="p-1 px-2 outline-none w-full text-gray-800"
                  :value="$v.uf_representante.$model"
                  @change="setUfRepresentante($event.target.value)"
                >
                  <option value="">--</option>
                  <option :value="'MG'">Minas Gerais</option>
                  <option :value="'SP'">São Paulo</option>
                  <option :value="'ES'">Espirito Santo</option>
                </select>
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.uf_representante.$dirty && !$v.uf_representante.required
                "
              >
                UF é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="celular_representante">Telefone</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="celular_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  v-mask="'(##)#####-####'"
                  :value="$v.celular_representante.$model"
                  @input="setCelularRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.celular_representante.$dirty &&
                  !$v.celular_representante.required
                "
              >
                Celular/Telefone é obrigatório
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.celular_representante.$dirty &&
                  !$v.celular_representante.minLength
                "
              >
                Celular/Telefone Inválido
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="email_representante">E-Mail</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="email_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="email"
                  :value="$v.email_representante.$model"
                  @input="setEmailRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.email_representante.$dirty &&
                  !$v.email_representante.required
                "
              >
                E-mail válido é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div class="flex flex-col">
                <label class="inline-flex items-center mt-3">
                  <input
                    type="checkbox"
                    class="form-checkbox h-5 w-5 text-gray-600 ml-2"
                    name="politicamente_exposto"
                  /><span class="ml-2 text-gray-700"
                    >Pessoa Politicamente Exposta</span
                  >
                </label>
              </div>
              <div class="grid lg:grid-cols-12 md:grid-cols-12 grid-flow-col">
                <div
                  class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
                >
                  <div
                    class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
                  >
                    <label for="cargo_politicamente_exposto">Cargo</label>
                  </div>
                  <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                    <input
                      id="cargo_politicamente_exposto"
                      class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                      type="text"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div class="flex flex-col">
                <label class="inline-flex items-center mt-3">
                  <input
                    type="checkbox"
                    class="form-checkbox h-5 w-5 text-gray-600 ml-2"
                    name="parente_politicamente_exposto"
                  /><span class="ml-2 text-gray-700"
                    >Parente Politicamente Exposta</span
                  >
                </label>
              </div>
            </div>
            <div
              class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="cargo_parente_politicamente_exposto">Cargo</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="cargo_parente_politicamente_exposto"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Sócios
        </div>
        <socios v-for="socio in socios" :key="socio" :kSocio="socio" />
        <div class="flex flex-row-reverse my-2">
          <button
            @click="removeSocioElement"
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-red-200 bg-red-100 text-red-700 border duration-200 ease-in-out border-red-600 transition"
          >
            Remover
          </button>

          <button
            :disabled="errors.invalid"
            :class="{ 'opacity-40': errors.invalid }"
            @click="addSocioElement"
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            Novo Sócio
          </button>
        </div>
      </div>

      <div class="flex p-2 mt-4">
        <button
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Finalizar
        </button>
        <div class="flex-auto flex flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-4' }">
            <button
              :disabled="$v.$invalid"
              :class="{ 'opacity-40': $v.$invalid }"
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
          <router-link :to="{ name: 'solicitacao-2' }">
            <button
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Retornar
            </button>
          </router-link>
        </div>
      </div>
    </div>
  </solicitacao>
</template>

<script>
import Solicitacao from "../Solicitacao.vue";
import { required, minLength } from "vuelidate/lib/validators";
import { mapGetters } from "vuex";

import Socios from "./Socios.vue";

export default {
  components: { Solicitacao, Socios },
  data() {
    return {
      nome_representante: "",
      cpf_representante: "",
      rg_representante: "",
      uf_rg_representante: "",
      nome_mae_representante: "",
      id_tipo_logradouro_representante: "",
      logradouro_representante: "",
      numero_representante: null,
      cep_representante: "",
      complemento_representante: "",
      bairro_representante: "",
      cidade_representante: "",
      uf_representante: "",
      celular_representante: "",
      email_representante: "",
      estado_civil_representante: "",
      profissao_representante: "",
      sexo_representante: "",
      socios: 0,
    };
  },
  computed: {
    ...mapGetters(["errors"]),
  },
  validations: {
    nome_representante: {
      required,
    },
    cpf_representante: {
      required,
    },
    rg_representante: {
      required,
    },
    uf_rg_representante: {
      required,
    },
    nome_mae_representante: {
      required,
    },
    id_tipo_logradouro_representante: {
      required,
    },
    logradouro_representante: {
      required,
    },
    numero_representante: {
      required,
    },
    cep_representante: {
      required,
      minLength: minLength(8),
    },
    complemento_representante: {},
    bairro_representante: {
      required,
    },
    cidade_representante: {
      required,
    },
    uf_representante: {
      required,
    },
    celular_representante: {
      required,
      minLength: minLength(11),
    },
    email_representante: {
      required,
    },
    estado_civil_representante: {
      required,
    },
    profissao_representante: {
      required,
    },
    sexo_representante: {
      required,
    },
  },
  methods: {
    setNomeRepresentante(value) {
      this.nome_representante = value;
      this.$v.nome_representante.$touch();
    },
    setRgRepresentante(value) {
      this.rg_representante = value;
      this.$v.rg_representante.$touch();
    },
    setUfRgRepresentante(value) {
      this.uf_rg_representante = value;
      this.$v.uf_rg_representante.$touch();
    },
    async setCpfRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      let isInvalid = await this.$store.dispatch("validaCPF", value);
      if (isInvalid) {
        this.cpf_representante = null;
      } else this.cpf_representante = value;
      this.$v.cpf_representante.$touch();
    },
    setEstadoCivilRepresentante(value) {
      this.estado_civil_representante = value;
      this.$v.estado_civil_representante.$touch();
    },
    setSexoRepresentante(value) {
      this.sexo_representante = value;
      this.$v.sexo_representante.$touch();
    },
    setNomeMaeRepresentante(value) {
      this.nome_mae_representante = value;
      this.$v.nome_mae_representante.$touch();
    },
    setProfissaoRepresentante(value) {
      this.profissao_representante = value;
      this.$v.profissao_representante.$touch();
    },
    setIdTipoLogradouroRepresentante(value) {
      this.id_tipo_logradouro_representante = value;
      this.$v.id_tipo_logradouro_representante.$touch();
    },
    setLogradouroRepresentante(value) {
      this.logradouro_representante = value;
      this.$v.logradouro_representante.$touch();
    },
    setNumeroRepresentante(value) {
      this.numero_representante = value;
      this.$v.numero_representante.$touch();
    },
    async setCepRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      let dadosEndereco = await this.$store.dispatch("getViaCep", value);
      console.log(dadosEndereco);
      if (dadosEndereco.erro) {
        this.setBairroRepresentante("");
        document.querySelector("#bairro_representante").disabled = false;

        this.setCidadeRepresentante("");
        document.querySelector("#cidade_representante").disabled = false;

        this.setLogradouroRepresentante("");
        document.querySelector("#logradouro_representante").disabled = false;

        this.setUfRepresentante("");
        document.querySelector("#uf_representante").disabled = false;

        this.cep_representante = null;
        this.$v.cep_representante.$touch();
      } else {
        this.setBairroRepresentante(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "")
          document.querySelector("#bairro_representante").disabled = true;

        this.setCidadeRepresentante(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "")
          document.querySelector("#cidade_representante").disabled = true;

        this.setLogradouroRepresentante(dadosEndereco.logradouro);
        if (dadosEndereco.logradouro != "")
          document.querySelector("#logradouro_representante").disabled = true;

        this.setUfRepresentante(dadosEndereco.uf);
        if (dadosEndereco.uf != "")
          document.querySelector("#uf_representante").disabled = true;

        this.setComplementoRepresentante(dadosEndereco.complemento);

        this.cep_representante = value;
        this.$v.cep_representante.$touch();
      }
    },
    setComplementoRepresentante(value) {
      this.complemento_representante = value;
      this.$v.complemento_representante.$touch();
    },
    setBairroRepresentante(value) {
      this.bairro_representante = value;
      this.$v.bairro_representante.$touch();
    },
    setCidadeRepresentante(value) {
      this.cidade_representante = value;
      this.$v.cidade_representante.$touch();
    },
    setUfRepresentante(value) {
      this.uf_representante = value;
      this.$v.uf_representante.$touch();
    },
    setCelularRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      this.celular_representante = value;
      this.$v.celular_representante.$touch();
    },
    setEmailRepresentante(value) {
      if (value.indexOf("@") != -1) this.email_representante = value;
      else this.email_representante = null;

      this.$v.email_representante.$touch();
    },
    addSocioElement() {
      this.socios++;
    },
    removeSocioElement() {
      if (this.socios > 0) {
        this.errors.invalid = false;
        --this.socios;
      }
    },
  },
};
</script>

<style>
</style>