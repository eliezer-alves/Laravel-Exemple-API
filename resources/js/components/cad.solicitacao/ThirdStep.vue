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
              />
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
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-mask="'###.###.###-##'"
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
              />
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="sexo">Sexo</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="sexo"
                name="sexo"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option :value="'M'">MASCULINO</option>
                <option :value="'F'">FEMININO</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cpf_representante">Profissão</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cpf_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="estado_civil">Estado Civil</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="estado_civil"
                name="estado_civil"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option :value="'S'">SOLTEIRO</option>
                <option :value="'C'">CASADO</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_mae">Nome da Mãe</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_mae"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
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
                <label for="id_tipo_logradouro">Tipo Logradouro</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <select
                  id="id_tipo_logradouro"
                  name="id_tipo_logradouro"
                  class="p-1 px-2 outline-none w-full text-gray-800"
                >
                  <option :value="1">RUA</option>
                  <option :value="2">AVENIDA</option>
                  <option :value="3">PRACA</option>
                </select>
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="logradouro">Logradouro</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="logradouro"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
              </div>
            </div>
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="numero">Número</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="numero"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="complemento">Complemento</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="complemento"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
              </div>
            </div>
            <div
              class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="cep">CEP</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="cep"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  v-mask="'#####-###'"
                />
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="bairro">Bairro</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="bairro"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
              </div>
            </div>
            <div
              class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="cidade">Cidade</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="cidade"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="text"
                />
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
                >
                  <option :value="'MG'">Minas Gerais</option>
                  <option :value="'SP'">São Paulo</option>
                  <option :value="'ES'">Espirito Santo</option>
                </select>
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
                />
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
                />
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
          Sócios (incluir o representante legal)
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_representante">Nome (Representante)</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_representante"
                name="nome_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Nome completo"
              />
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cpf_representante">CPF Representante</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cpf_representante"
                name="cpf_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="###.###.###-##"
                v-mask="'###.###.###-##'"
              />
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
              >
                <option :value="'MG'">Minas Gerais</option>
                <option :value="'RJ'">Rio de Janeiro</option>
                <option :value="'SP'">São Paulo</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="numero_rg_representante">Nº do RG</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="numero_rg_representante"
                name="numero_rg_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
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
              >
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="estado_civil_representante">Estado Cívil</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="estado_civil_representante"
                name="estado_civil_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option value="1">Casado</option>
                <option value="2">Solteiro</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="email_representante">E-mail</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="email_representante"
                name="email_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="mail@brasilcard.net"
              />
            </div>
          </div>
          <div
            class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="telefone_representante">Telefone</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="telefone_representante"
                name="telefone_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="###.###.###-##"
                v-mask="['(##) ####-####', '(##) #####-####']"
              />
            </div>
          </div>
        </div>
        <div
          class="grid lg:grid-cols-12 md:grid-cols-12 border-t-2 border-teal-600 mt-5"
        >
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
                name="cep_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="#####-###"
                v-mask="'#####-###'"
              />
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
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="uf_representante"
                name="uf_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option value="MG">Minas Gerais</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="SP">São Paulo</option>
              </select>
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
                name="cidade_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Cidade"
              />
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
                name="bairro_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Bairro"
              />
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="tipo_logradouro_representante"
                >Tipo de Logradouro</label
              >
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="tipo_logradouro_representante"
                name="tipo_logradouro_representante"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option :value="1">Rua</option>
                <option :value="2">Avenida</option>
                <option :value="3">Praça</option>
              </select>
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
                name="logradouro_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
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
                name="numero_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
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
                name="complemento_representante"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
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
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            Simular
          </button>
        </div>
      </div>
    </div>
  </solicitacao>
</template>

<script>
import Solicitacao from "../Solicitacao.vue";
export default {
  components: { Solicitacao },
  data() {
    return {
      price: 123.45,
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        suffix: "",
        precision: 2,
        masked: false /* doesn't work with directive */,
      },
    };
  },
};
</script>

<style>
</style>