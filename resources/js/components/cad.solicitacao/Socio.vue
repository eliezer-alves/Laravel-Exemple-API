<template>
  <div>
    <div class="grid lg:grid-cols-12 md:grid-cols-12">
      <div
        class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'nome_socio_' + socio.id">Nome</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'nome_socio_' + socio.id"
            :name="'nome_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Nome completo"
            v-model="$v.socio.nome.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.nome.$dirty && !$v.socio.nome.required"
        >
          Nome obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'cpf_socio_' + socio.id">CPF</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cpf_socio_' + socio.id"
            :name="'cpf_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800 cpf"
            type="text"
            placeholder="###.###.###-##"
            v-mask="'###.###.###-##'"
            :value="$v.socio.cpf.$model"
            @blur="setCpfSocio($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.cpf.$dirty && !$v.socio.cpf.required"
        >
          CPF válido é obrigatório.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.cpf.$dirty && $v.socio.cpf.invalid"
        >
          CPF inválido.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.cpf.$dirty && $v.socio.cpf.repeated"
        >
          Este CPF já é pertence a outro sócio.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'uf_rg_socio_' + socio.id">UF do RG</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'uf_rg_socio_' + socio.id"
            :name="'uf_rg_socio_' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            v-model="$v.socio.uf_rg.$model"
          >
            <option value="">--</option>
            <option
              v-for="uf_rg in dominios.uf"
              :key="uf_rg.codigo"
              :value="uf_rg.codigo"
            >
              {{ uf_rg.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.uf_rg.$dirty && !$v.socio.uf_rg.required"
        >
          UF do RG é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'numero_rg_socio_' + socio.id">Nº do RG</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'numero_rg_socio_' + socio.id"
            :name="'numero_rg_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="number"
            v-model.number="$v.socio.numero_rg.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.numero_rg.$dirty && !$v.socio.numero_rg.required"
        >
          RG é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'sexo_socio_' + socio.id">Sexo</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'sexo_socio_' + socio.id"
            :name="'sexo_socio_' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            v-model="$v.socio.sexo.$model"
          >
            <option value="">--</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.sexo.$dirty && !$v.socio.sexo.required"
        >
          Sexo é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'estado_civil_socio_' + socio.id">Estado Cívil</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'estado_civil_socio_' + socio.id"
            :name="'estado_civil_socio_' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            v-model="$v.socio.estado_civil.$model"
          >
            <option value="">--</option>
            <option
              v-for="estado_civil in dominios.estadoCivil"
              :key="estado_civil.codigo"
              :value="estado_civil.codigo"
            >
              {{ estado_civil.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.estado_civil.$dirty && !$v.socio.estado_civil.required"
        >
          Estado Civil é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'profissao' + socio.id">Profissão</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'profissao' + socio.id"
            :name="'profissao' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            v-model="$v.socio.profissao.$model"
          >
            <option value="">--</option>
            <option
              v-for="profissoes in dominios.profissao"
              :key="profissoes.codigo"
              :value="profissoes.codigo"
            >
              {{ profissoes.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.profissao.$dirty && !$v.socio.profissao.required"
        >
          Profissão é obrigatória
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'renda_mensal' + socio.id">Rendimento Mensal</label>
        </div>
        <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
          <input
            :id="'renda_mensal' + socio.id"
            :name="'renda_mensal' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-money="money"
            :value="$v.socio.renda_mensal.$model"
            @input="setRendaMensal($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.renda_mensal.$dirty && !$v.socio.renda_mensal.required"
        >
          Rendimento Mensal é obrigatório.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.renda_mensal.$dirty && !$v.socio.renda_mensal.minValue"
        >
          Valor mínimo de R$
          {{ $v.socio.renda_mensal.$params.minValue.min / 100 }},00.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'email_socio_' + socio.id">E-mail</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'email_socio_' + socio.id"
            :name="'email_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="mail@brasilcard.net"
            @blur="setEmailSocio($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="
            $v.socio.email.$dirty &&
            (!$v.socio.email.required || !$v.socio.email.email)
          "
        >
          E-mail válido é obrigatório.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.email.$dirty && $v.socio.email.repeated"
        >
          Este e-mail já é pertence a outro sócio.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'telefone_socio_' + socio.id">Telefone</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'telefone_socio_' + socio.id"
            :name="'telefone_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-mask="['(##) ####-####', '(##) #####-####']"
            :value="$v.socio.telefone.$model"
            @blur="setTelefoneSocio($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.telefone.$dirty && !$v.socio.telefone.required"
        >
          Telefone é obrigatório.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.telefone.$dirty && $v.socio.telefone.repeated"
        >
          Este telefone já é pertence a outro sócio.
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.telefone.$dirty && !$v.socio.telefone.minLength"
        >
          Celular/Telefone tem o mínimo de 10 caracteres.
        </div>
      </div>
    </div>
    <div
      class="grid lg:grid-cols-12 md:grid-cols-12 border-t-2 border-b-2 border-teal-600 mt-5"
    >
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'cep_socio_' + socio.id">CEP</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cep_socio_' + socio.id"
            :name="'cep_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="#####-###"
            v-mask="'#####-###'"
            :value="$v.socio.cep.$model"
            @blur="setCepSocio($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.cep.$dirty && !$v.socio.cep.required"
        >
          CEP é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'uf_socio_' + socio.id">UF</label>
        </div>
        <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
          <select
            :id="'uf_socio_' + socio.id"
            :name="'uf_socio_' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            disabled
            v-model="$v.socio.uf.$model"
          >
            <option value="">--</option>
            <option
              v-for="uf in dominios.uf"
              :key="uf.codigo"
              :value="uf.codigo"
            >
              {{ uf.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.uf.$dirty && !$v.socio.uf.required"
        >
          UF é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'cidade_socio_' + socio.id">Cidade</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cidade_socio_' + socio.id"
            :name="'cidade_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Cidade"
            disabled
            v-model="$v.socio.cidade.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.cidade.$dirty && !$v.socio.cidade.required"
        >
          Cidade é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'bairro_socio_' + socio.id">Bairro</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'bairro_socio_' + socio.id"
            :name="'bairro_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Bairro"
            v-model="$v.socio.bairro.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.bairro.$dirty && !$v.socio.bairro.required"
        >
          Bairro é obrigatório.
        </div>
      </div>

      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3 truncate"
        >
          <label :for="'tipo_logradouro_socio_' + socio.id">
            Tipo de Logradouro
          </label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'tipo_logradouro_socio_' + socio.id"
            :name="'tipo_logradouro_socio_' + socio.id"
            class="p-1 px-2 outline-none w-full text-gray-800"
            v-model="$v.socio.tipo_logradouro.$model"
          >
            <option value="">--</option>
            <option
              v-for="tipo_logradouro in dominios.tipoLogradouro"
              :key="tipo_logradouro.id_tipo_logradouro"
              :value="tipo_logradouro.id_tipo_logradouro"
            >
              {{ tipo_logradouro.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="
            $v.socio.tipo_logradouro.$dirty &&
            !$v.socio.tipo_logradouro.required
          "
        >
          Tipo de Logradouro é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'logradouro_socio_' + socio.id">Logradouro</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'logradouro_socio_' + socio.id"
            :name="'logradouro_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-model="$v.socio.logradouro.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.logradouro.$dirty && !$v.socio.logradouro.required"
        >
          Logradouro é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'numero_socio_' + socio.id">Número</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'numero_socio_' + socio.id"
            :name="'numero_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="number"
            v-model="$v.socio.numero.$model"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.socio.numero.$dirty && !$v.socio.numero.required"
        >
          Número é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-9 md:col-span-9 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label :for="'complemento_socio_' + socio.id">Complemento</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'complemento_socio_' + socio.id"
            :name="'complemento_socio_' + socio.id"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-model="$v.socio.complemento.$model"
          />
        </div>
      </div>
      <div
        class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div class="flex flex-col">
          <label class="inline-flex items-center mt-3">
            <input
              id="politicamente_exposto"
              name="politicamente_exposto"
              type="checkbox"
              class="form-checkbox h-5 w-5 text-gray-600 ml-2"
              v-model="
                $v.socio.politicamente_exposto.$model
              "
            />
            <span class="ml-2 text-gray-700">
              Pessoa Politicamente Exposta
            </span>
          </label>
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12 grid-flow-col">
          <div
            class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="politicamente_exposto_cargo">
                Cargo
              </label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="politicamente_exposto_cargo"
                name="politicamente_exposto_cargo"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-model="
                  $v.socio.politicamente_exposto_cargo
                    .$model
                "
              />
            </div>
          </div>
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div class="flex flex-col">
          <label class="inline-flex items-center mt-3">
            <input
              id="parente_politicamente_exposto"
              name="parente_politicamente_exposto"
              type="checkbox"
              class="form-checkbox h-5 w-5 text-gray-600 ml-2"
              v-model="
                $v.socio.parente_politicamente_exposto
                  .$model
              "
            />
            <span class="ml-2 text-gray-700">
              Parente Politicamente Exposto
            </span>
          </label>
        </div>
      </div>

      <div
        class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="parente_politicamente_exposto_cargo"
            >Cargo</label
          >
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            id="parente_politicamente_exposto_cargo"
            name="parente_politicamente_exposto_cargo"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-model="
              $v.socio.parente_politicamente_exposto_cargo
                .$model
            "
          />
        </div>
      </div>
    </div>
    <div class="flex flex-row-reverse my-2">
      <button
        @click="removeSocio"
        class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-red-200 bg-red-100 text-red-700 border duration-200 ease-in-out border-red-600 transition"
      >
        Remover
      </button>
      <button
        @click="salvarSocio"
        class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
      >
        Confirmar Sócio
      </button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { required, minValue, minLength, email } from "vuelidate/lib/validators";
import { validaCPF } from "../../helper.js";

export default {
  name: "socio",
  props: ["id"],
  computed: {
    ...mapGetters(["dominios", "solicitacao", "errors"]),
  },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
      },
      socio: {},
    };
  },
  async mounted() {
    this.$store.commit("ERRORS", {
      invalid: this.$v.$invalid,
    });
    this.socio = this.getSocio();
    await this.$store.dispatch("fetchDominios");
  },
  validations: {
    socio: {
      nome: { required },
      cpf: { required },
      uf_rg: { required },
      numero_rg: { required },
      sexo: { required },
      estado_civil: { required },
      profissao: { required },
      renda_mensal: { required, minValue: minValue(100) },
      email: { required, email },
      telefone: { required, minLength: minLength(10) },
      cep: { required },
      uf: { required },
      cidade: { required },
      bairro: { required },
      tipo_logradouro: { required },
      logradouro: { required },
      numero: { required },
      complemento: {},
      politicamente_exposto: {},
      politicamente_exposto_cargo: {},
      parente_politicamente_exposto: {},
      parente_politicamente_exposto_cargo: {},
    },
  },
  methods: {
    getSocio() {
      const index = this.solicitacao.socios.findIndex(
        (socio) => socio.id === this.id
      );
      return this.solicitacao.socios[index];
    },
    setNomeSocio(value) {
      this.socio.nome = value;
      this.$v.socio.nome.$touch();
    },
    setCpfSocio(value) {
      value = value.replace(/[^\d]+/g, "");

      this.$v.socio.cpf.repeated = this.verificaCpfRepetido(value);
      this.$v.socio.cpf.invalid = validaCPF(value);

      this.$v.socio.cpf.$model = value;
      this.$v.socio.cpf.$touch();
    },
    verificaCpfRepetido(cpf) {
      if (this.solicitacao.cpf_representante === cpf) return true;
      const index = this.solicitacao.socios.findIndex(
        (socio) => socio.cpf === cpf
      );
      return index >= 0 ? true : false;
    },
    setRendaMensal(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.socio.renda_mensal.$model = value;
      this.$v.socio.renda_mensal.$touch();
    },
    setTelefoneSocio(value) {
      value = value.replace(/[^\d]+/g, "");

      this.$v.socio.telefone.repeated = this.verificaTelefoneRepetido(value);
      this.$v.socio.telefone.$model = value;
      this.$v.socio.telefone.$touch();
    },
    verificaTelefoneRepetido(telefone) {
      if (this.solicitacao.celular_representante === telefone) return true;
      const index = this.solicitacao.socios.findIndex(
        (socio) => socio.telefone === telefone
      );
      return index >= 0 ? true : false;
    },
    setEmailSocio(value) {
      this.$v.socio.email.repeated = this.verificaEmailRepetido(value);
      this.$v.socio.email.$model = value;
      this.$v.socio.email.$touch();
    },
    verificaEmailRepetido(email) {
      if (this.solicitacao.email_representante === email) return true;
      const index = this.solicitacao.socios.findIndex(
        (socio) => socio.email === email
      );
      return index >= 0 ? true : false;
    },
    async setCepSocio(value) {
      value = value.replace(/[^\d]+/g, "");
      let dadosEndereco = await this.$store.dispatch("getViaCep", value);
      if (dadosEndereco.erro) {
        this.setBairroSocio("");
        document.querySelector(`#bairro_socio_${this.id}`).disabled = false;

        this.setCidadeSocio("");
        document.querySelector(`#cidade_socio_${this.id}`).disabled = false;

        this.setLogradouroSocio("");

        this.setUfSocio("");
        document.querySelector(`#uf_socio_${this.id}`).disabled = false;

        this.setComplementoSocio("");

        this.socio.cep = null;
        this.$v.socio.cep.$touch();
      } else {
        this.setBairroSocio(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "") {
          document.querySelector(`#bairro_socio_${this.id}`).disabled = true;
        } else {
          document.querySelector(`#bairro_socio_${this.id}`).disabled = false;
        }

        this.setCidadeSocio(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "") {
          document.querySelector(`#cidade_socio_${this.id}`).disabled = true;
        } else {
          document.querySelector(`#cidade_socio_${this.id}`).disabled = false;
        }

        this.setLogradouroSocio(dadosEndereco.logradouro);

        this.setUfSocio(dadosEndereco.uf);
        if (dadosEndereco.uf != "") {
          document.querySelector(`#uf_socio_${this.id}`).disabled = true;
        } else {
          document.querySelector(`#uf_socio_${this.id}`).disabled = false;
        }

        this.setComplementoSocio(dadosEndereco.complemento);

        this.socio.cep = value;
        this.$v.socio.cep.$touch();
      }
    },
    setUfSocio(value) {
      this.socio.uf = value;
      this.$v.socio.uf.$touch();
    },
    setCidadeSocio(value) {
      this.socio.cidade = value;
      this.$v.socio.cidade.$touch();
    },
    setBairroSocio(value) {
      this.socio.bairro = value;
      this.$v.socio.bairro.$touch();
    },
    setComplementoSocio(value) {
      this.socio.complemento = value;
      this.$v.socio.complemento.$touch();
    },
    setTipoLogradouroSocio(value) {
      this.socio.tipo_logradouro = value;
      this.$v.socio.tipo_logradouro.$touch();
    },
    setLogradouroSocio(value) {
      this.socio.logradouro = value;
      this.$v.socio.logradouro.$touch();
    },
    setNumeroSocio(value) {
      this.socio.numero = value;
      this.$v.socio.numero.$touch();
    },
    salvarSocio() {
      if (!this.$v.$invalid) {
        const index = this.solicitacao.socios.findIndex(
          (socio) => socio.id === this.id
        );
        if (index >= 0) {
          this.socio.valid = true;
          this.solicitacao.socios[index] = this.socio;
          this.$emit("update:validSocioElement", !this.$v.$invalid);
          this.$swal({
            title: "Sócio adicionado.",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
          });
          // console.log(this.solicitacao.socios[index]);
        }
      } else {
        this.$swal({
          title: "Preencha todos os campos do sócio.",
          icon: "warning",
          showConfirmButton: false,
          timer: 1500,
        });
      }
      this.$v.$touch();
    },
    removeSocio() {
      this.$emit("remove", this.id);
    },
  },
};
</script>

<style>
</style>