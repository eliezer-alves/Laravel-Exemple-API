<template>
  <transition name="fade">
    <solicitacao>
      <div class="p-4">
        <div class="my-1">
          <div
            class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm"
          >
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
                  v-model.trim="$v.solicitacao.nome_representante.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.nome_representante.$dirty &&
                  !$v.solicitacao.nome_representante.required
                "
              >
                Nome do Representante é obrigatório
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
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800 cpf"
                  type="text"
                  v-mask="'###.###.###-##'"
                  :value="$v.solicitacao.cpf_representante.$model"
                  @input="setCpfRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.cpf_representante.$dirty &&
                  !$v.solicitacao.cpf_representante.required
                "
              >
                CPF válido é obrigatório.
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.cpf_representante.$dirty &&
                  $v.solicitacao.cpf_representante.invalid
                "
              >
                CPF inválido.
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
                  v-model="$v.solicitacao.uf_rg_representante.$model"
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
                v-if="
                  $v.solicitacao.uf_rg_representante.$dirty &&
                  !$v.solicitacao.uf_rg_representante.required
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
                <label for="rg_representante">RG</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="rg_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  v-model="$v.solicitacao.rg_representante.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.rg_representante.$dirty &&
                  !$v.solicitacao.rg_representante.required
                "
              >
                RG é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                  v-model.trim="$v.solicitacao.nome_mae_representante.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.nome_mae_representante.$dirty &&
                  !$v.solicitacao.nome_mae_representante.required
                "
              >
                Nome da Mãe é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                  v-model="$v.solicitacao.estado_civil_representante.$model"
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
                v-if="
                  $v.solicitacao.estado_civil_representante.$dirty &&
                  !$v.solicitacao.estado_civil_representante.required
                "
              >
                Estado Civil é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                  v-model="$v.solicitacao.sexo_representante.$model"
                >
                  <option value="">--</option>
                  <option :value="'M'">Masculino</option>
                  <option :value="'F'">Feminino</option>
                </select>
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.sexo_representante.$dirty &&
                  !$v.solicitacao.sexo_representante.required
                "
              >
                Sexo é obrigatório
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                  v-model="$v.solicitacao.profissao_representante.$model"
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
                v-if="
                  $v.solicitacao.profissao_representante.$dirty &&
                  !$v.solicitacao.profissao_representante.required
                "
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
                <label for="renda_mensal_representante"
                  >Rendimento Mensal</label
                >
              </div>
              <div
                class="bg-white my-2 p-1 flex border border-gray-200 rounded"
              >
                <input
                  id="renda_mensal_representante"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                  v-money="money"
                  :value="$v.solicitacao.renda_mensal_representante.$model"
                  @input="setRendaMensalRepresentante($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.renda_mensal_representante.$dirty &&
                  !$v.solicitacao.renda_mensal_representante.required
                "
              >
                Rendimento Mensal é obrigatório.
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.renda_mensal_representante.$dirty &&
                  !$v.solicitacao.renda_mensal_representante.minValue
                "
              >
                Valor mínimo de R$
                {{
                  $v.solicitacao.renda_mensal_representante.$params.minValue
                    .min / 100
                }},00.
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
                class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    :value="$v.solicitacao.cep_representante.$model"
                    @blur="setCepRepresentante($event.target.value)"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.cep_representante.$dirty &&
                    !$v.solicitacao.cep_representante.required
                  "
                >
                  Digite um CEP válido
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.cep_representante.$dirty &&
                    !$v.solicitacao.cep_representante.minLength
                  "
                >
                  CEP inválido
                </div>
              </div>
              <div
                class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    v-model="$v.solicitacao.uf_representante.$model"
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
                  v-if="
                    $v.solicitacao.uf_representante.$dirty &&
                    !$v.solicitacao.uf_representante.required
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
                  <label for="cidade_representante">Cidade</label>
                </div>
                <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                  <input
                    id="cidade_representante"
                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                    type="text"
                    v-model.trim="$v.solicitacao.cidade_representante.$model"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.cidade_representante.$dirty &&
                    !$v.solicitacao.cidade_representante.required
                  "
                >
                  Cidade é obrigatória
                </div>
              </div>
              <div
                class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    v-model.trim="$v.solicitacao.bairro_representante.$model"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.bairro_representante.$dirty &&
                    !$v.solicitacao.bairro_representante.required
                  "
                >
                  Bairro é obrigatório
                </div>
              </div>
              <div
                class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
              >
                <div
                  class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3 truncate"
                >
                  <label for="id_tipo_logradouro_representante"
                    >Tipo de Logradouro</label
                  >
                </div>
                <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                  <select
                    id="id_tipo_logradouro_representante"
                    name="id_tipo_logradouro_representante"
                    class="p-1 px-2 outline-none w-full text-gray-800"
                    v-model="
                      $v.solicitacao.id_tipo_logradouro_representante.$model
                    "
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
                    $v.solicitacao.id_tipo_logradouro_representante.$dirty &&
                    !$v.solicitacao.id_tipo_logradouro_representante.required
                  "
                >
                  Tipo do Logradouro é obrigatório
                </div>
              </div>
              <div
                class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    v-model.trim="
                      $v.solicitacao.logradouro_representante.$model
                    "
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.logradouro_representante.$dirty &&
                    !$v.solicitacao.logradouro_representante.required
                  "
                >
                  Logradouro é obrigatório
                </div>
              </div>
              <div
                class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    type="number"
                    v-model.number="$v.solicitacao.numero_representante.$model"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.numero_representante.$dirty &&
                    !$v.solicitacao.numero_representante.required
                  "
                >
                  Número é obrigatório
                </div>
              </div>
              <div
                class="lg:col-span-9 md:col-span-9 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                    v-model.trim="
                      $v.solicitacao.complemento_representante.$model
                    "
                  />
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
                    v-mask="['(##) ####-####', '(##) #####-####']"
                    :value="$v.solicitacao.celular_representante.$model"
                    @input="setCelularRepresentante($event.target.value)"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.celular_representante.$dirty &&
                    !$v.solicitacao.celular_representante.required
                  "
                >
                  Celular/Telefone é obrigatório
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.celular_representante.$dirty &&
                    !$v.solicitacao.celular_representante.minLength
                  "
                >
                  Celular/Telefone tem o mínimo de 10 caracteres.
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
                    v-model.trim="$v.solicitacao.email_representante.$model"
                  />
                </div>
                <div
                  class="text-red-600"
                  v-if="
                    $v.solicitacao.email_representante.$dirty &&
                    (!$v.solicitacao.email_representante.required ||
                      !$v.solicitacao.email_representante.email)
                  "
                >
                  E-mail válido é obrigatório.
                </div>
              </div>
              <div
                class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
              >
                <div class="flex flex-col">
                  <label class="inline-flex items-center mt-3">
                    <input
                      id="representante_politicamente_exposto"
                      name="representante_politicamente_exposto"
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-gray-600 ml-2"
                      v-model="
                        $v.solicitacao.representante_politicamente_exposto
                          .$model
                      "
                    />
                    <span class="ml-2 text-gray-700">
                      Pessoa Politicamente Exposta
                    </span>
                  </label>
                </div>

                <transition name="fade">
                  <div
                    v-if="
                      $v.solicitacao.representante_politicamente_exposto.$model
                    "
                    class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
                  >
                    <div
                      class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
                    >
                      <label for="representante_politicamente_exposto_cargo">
                        Cargo
                      </label>
                    </div>
                    <div
                      class="bg-white my-2 p-1 border border-gray-200 rounded"
                    >
                      <input
                        id="representante_politicamente_exposto_cargo"
                        name="representante_politicamente_exposto_cargo"
                        class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                        type="text"
                        v-model.trim="
                          $v.solicitacao
                            .representante_politicamente_exposto_cargo.$model
                        "
                      />
                    </div>
                  </div>
                </transition>
              </div>
              <div
                class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
              >
                <div class="flex flex-col">
                  <label class="inline-flex items-center mt-3">
                    <input
                      id="parente_representante_politicamente_exposto"
                      name="parente_representante_politicamente_exposto"
                      type="checkbox"
                      class="form-checkbox h-5 w-5 text-gray-600 ml-2"
                      v-model="
                        $v.solicitacao
                          .parente_representante_politicamente_exposto.$model
                      "
                    />
                    <span class="ml-2 text-gray-700">
                      Parente Politicamente Exposto
                    </span>
                  </label>
                </div>
              </div>

              <transition name="fade">
                <div
                  v-if="
                    $v.solicitacao.parente_representante_politicamente_exposto
                      .$model
                  "
                  class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
                >
                  <div
                    class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
                  >
                    <label
                      for="parente_representante_politicamente_exposto_cargo"
                      >Cargo</label
                    >
                  </div>
                  <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                    <input
                      id="parente_representante_politicamente_exposto_cargo"
                      name="parente_representante_politicamente_exposto_cargo"
                      class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                      type="text"
                      v-model.trim="
                        $v.solicitacao
                          .parente_representante_politicamente_exposto_cargo
                          .$model
                      "
                    />
                  </div>
                </div>
              </transition>
            </div>
          </div>
        </div>

        <div class="my-2">
          <div
            class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm"
          >
            Sócios
          </div>
          <transition-group name="component-fade" tag="div">
            <socio
              v-for="socio in this.solicitacao.socios"
              :id="socio.id"
              :key="socio.id"
              :socio="socio"
              @remove="removeSocioElement"
              :validSocioElement.sync="validSocioElement"
            />
          </transition-group>
          <div class="flex flex-row-reverse my-2">
            <button
              :disabled="!validSocioElement"
              :class="{ 'opacity-40': !validSocioElement }"
              @click="addSocioElement"
              class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
            >
              Novo Sócio
            </button>
          </div>
        </div>

        <div class="flex p-2 mt-4">
          <router-link :to="{ name: 'home' }">
            <button
              class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
            >
              Finalizar
            </button>
          </router-link>
          <div class="flex-auto flex flex-row-reverse">
            <button
              @click="validateFields"
              :class="{ 'opacity-40': $v.$invalid }"
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>

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
  </transition>
</template>

<script>
import Solicitacao from "../Solicitacao.vue";
import Socio from "./Socio.vue";

import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";

import { required, minLength, minValue, email } from "vuelidate/lib/validators";
import { validaCPF } from "../../helper.js";

export default {
  components: { Solicitacao, Socio },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
      },
    };
  },
  computed: {
    ...mapGetters(["dominios", "solicitacao", "errors"]),
    ...mapFields(["solicitacao", "errors"]),
    validSocioElement: function () {
      const index = this.solicitacao.socios.findIndex((s) => s.valid === false);
      if (index >= 0) return false;
      return true;
    },
  },
  async mounted() {
    await this.$store.dispatch("fetchDominios");
  },
  validations: {
    solicitacao: {
      nome_representante: { required },
      cpf_representante: { required },
      uf_rg_representante: { required },
      rg_representante: { required },
      sexo_representante: { required },
      profissao_representante: { required },
      renda_mensal_representante: { required, minValue: minValue(100) },
      estado_civil_representante: { required },
      nome_mae_representante: { required },
      id_tipo_logradouro_representante: { required },
      logradouro_representante: { required },
      numero_representante: { required },
      complemento_representante: {},
      cep_representante: { required, minLength: minLength(8) },
      bairro_representante: { required },
      cidade_representante: { required },
      uf_representante: { required },
      celular_representante: { required, minLength: minLength(10) },
      email_representante: { required, email },
      representante_politicamente_exposto: {},
      representante_politicamente_exposto_cargo: {},
      parente_representante_politicamente_exposto: {},
      parente_representante_politicamente_exposto_cargo: {},
    },
  },
  methods: {
    async setCpfRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.solicitacao.cpf_representante.invalid = validaCPF(value);
      this.solicitacao.cpf_representante = value;
      this.$v.solicitacao.cpf_representante.$touch();
    },
    setRendaMensalRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.solicitacao.renda_mensal_representante.$model = value;
      this.$v.solicitacao.renda_mensal_representante.$touch();
    },
    async setCepRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      let dadosEndereco = await this.$store.dispatch("getViaCep", value);

      if (dadosEndereco.erro) {
        this.setBairroRepresentante("");
        document.querySelector("#bairro_representante").disabled = false;

        this.setCidadeRepresentante("");
        document.querySelector("#cidade_representante").disabled = false;

        this.setLogradouroRepresentante("");

        this.setUfRepresentante("");
        document.querySelector("#uf_representante").disabled = false;
        this.setComplementoRepresentante("");

        this.$v.solicitacao.cep_representante.$model = null;
        this.$v.solicitacao.cep_representante.$touch();
      } else {
        this.setBairroRepresentante(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "")
          document.querySelector("#bairro_representante").disabled = true;

        this.setCidadeRepresentante(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "")
          document.querySelector("#cidade_representante").disabled = true;

        this.setLogradouroRepresentante(dadosEndereco.logradouro);

        this.setUfRepresentante(dadosEndereco.uf);
        if (dadosEndereco.uf != "")
          document.querySelector("#uf_representante").disabled = true;

        this.setComplementoRepresentante(dadosEndereco.complemento);
        this.$v.solicitacao.cep_representante.$model = value;
        this.$v.solicitacao.cep_representante.$touch();
      }
    },
    setCelularRepresentante(value) {
      value = value.replace(/[^\d]+/g, "");
      this.solicitacao.celular_representante = value;
      this.$v.solicitacao.celular_representante.$touch();
    },
    setIdTipoLogradouroRepresentante(value) {
      this.solicitacao.id_tipo_logradouro_representante = value;
      this.$v.solicitacao.id_tipo_logradouro_representante.$touch();
    },
    setLogradouroRepresentante(value) {
      this.solicitacao.logradouro_representante = value;
      this.$v.solicitacao.logradouro_representante.$touch();
    },
    setNumeroRepresentante(value) {
      this.solicitacao.numero_representante = value;
      this.$v.solicitacao.numero_representante.$touch();
    },
    setComplementoRepresentante(value) {
      this.solicitacao.complemento_representante = value;
      this.$v.solicitacao.complemento_representante.$touch();
    },
    setBairroRepresentante(value) {
      this.solicitacao.bairro_representante = value;
      this.$v.solicitacao.bairro_representante.$touch();
    },
    setCidadeRepresentante(value) {
      this.solicitacao.cidade_representante = value;
      this.$v.solicitacao.cidade_representante.$touch();
    },
    setUfRepresentante(value) {
      this.solicitacao.uf_representante = value;
      this.$v.solicitacao.uf_representante.$touch();
    },
    addSocioElement() {
      this.solicitacao.socios.push({
        id: this.solicitacao.socio_count++,
        valid: false,
        nome: "",
        cpf: "",
        uf_rg: "",
        numero_rg: "",
        sexo: "",
        estado_civil: "",
        profissao: "",
        renda_mensal: 100,
        email: "",
        telefone: "",
        cep: "",
        uf: "",
        cidade: "",
        bairro: "",
        tipo_logradouro: "",
        logradouro: "",
        numero: "",
        complemento: "",
        politicamente_exposto: "",
        politicamente_exposto_cargo: "",
        parente_politicamente_exposto: "",
        parente_politicamente_exposto_cargo: "",
      });
    },
    removeSocioElement(id) {
      const index = this.solicitacao.socios.findIndex((s) => s.id === id);
      this.solicitacao.socios.splice(index, 1);
    },
    validSocio() {
      const index = this.solicitacao.socios.findIndex((s) => s.valid === false);
      if (index >= 0) return false;
      return true;
    },
    validateFields() {
      if (!this.$v.$invalid) {
        this.$router.push("solicitacao-4");
      }
      this.$v.$touch();
    },
  },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s ease;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.component-fade-enter-active,
.component-fade-leave-active {
  transition: opacity 0.7s;
}

.component-fade-enter, .component-fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>