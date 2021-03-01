<template>
  <solicitacao>
    <div class="p-4">
      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Dados da Empresa
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="razao_social">Razão Social</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="razao_social"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Razão Social"
              />
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cnpj">CNPJ</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="cnpj"
                placeholder="##.###.###/####-##"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.###/####-##'"
              />
            </div>
          </div>
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_fantasia">Nome Fantasia</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_fantasia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Nome Fantasia"
              />
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="inscricao_estadual">Inscrição Estadual</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="inscricao_estadual"
                placeholder="##.###.####-#"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.####-#'"
              />
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="rendimento_mensal">Rendimento Mensal</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="rendimento_mensal"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="ramo_atividade">Ramo de Atividade</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="ramo_atividade"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-12 md:col-span-12 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="tipo_empresa">Tipo de Empresa</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="tipo_empresa"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Endereço / Contato
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cep">CEP</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cep"
                name="cep"
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
              <label for="cnpj">UF</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="cnpj"
                name="cnpj"
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
              <label for="cidade">Cidade</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cidade"
                name="cidade"
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
              <label for="bairro">Bairro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="bairro"
                name="bairro"
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
              <label for="tipo_logradouro">Tipo de Logradouro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="tipo_logradouro"
                name="tipo_logradouro"
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
              <label for="logradouro">Logradouro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="logradouro"
                name="logradouro"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-1 md:col-span-1 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="numero">Número</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="numero"
                name="numero"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="complemento">Complemento</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="complemento"
                name="complemento"
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
              <label for="celular">Telefone</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="celular"
                name="celular"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-mask="['(##) ####-####', '(##) #####-####']"
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="email">E-mail</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="email"
                name="email"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="email"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Arquivos do Contrato Social
        </div>

        <div
          class="flex lg:flex-row md:flex-row flex-col font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
        >
          <div class="self-center">
            <label
              class="w-56 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-teal-800 cursor-pointer hover:bg-teal-800 hover:text-white"
            >
              <svg
                class="w-8 h-8"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                />
              </svg>
              <span class="mt-2 text-base leading-normal"
                >Selecione o arquivo</span
              >
              <input
                id="contrato_social"
                name="contrato_social"
                type="file"
                class="hidden"
              />
            </label>
          </div>

          <div class="lg:ml-5 md:ml-5 self-center">
            <span class="text-base leading-normal">
              Nome do Arquivo Selecionado
            </span>
          </div>
        </div>
        <div class="flex flex-row-reverse">
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-red-200 bg-red-100 text-red-700 border duration-200 ease-in-out border-red-600 transition"
          >
            Remover
          </button>
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            Novo Documento
          </button>
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

      <div class="flex p-2 mt-5">
        <button
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-300 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Finalizar
        </button>
        <div class="flex-auto flex lg:flex-row-reverse md:flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-3' }">
            <button
              class="text-base mx-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
          <router-link :to="{ name: 'solicitacao' }">
            <button
              class="text-base mx-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
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
/* 
<div class="my-2">
  <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
    Arquivos do Contrato Social
  </div>
  <div class="grid lg:grid-cols-12 md:grid-cols-12">
    <div
      class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
    >
      <div
        class="font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
      >
        <label
          class="w-56 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-teal-800"
        >
          <svg
            class="w-8 h-8"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
            />
          </svg>
          <span class="mt-2 text-base leading-normal"
            >Selecione o arquivo</span
          >
          <input type="file" class="hidden" />
        </label>
      </div>
    </div>
    <div
      class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1 align-middle"
    >
      <div
        class="font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3 lg:text-center md:text-center"
      >
        <span class="mt-2 text-base leading-normal">
          Nome do Arquivo Selecionado
        </span>
      </div>
    </div>
  </div>
</div> */