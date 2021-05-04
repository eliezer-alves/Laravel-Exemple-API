<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ mix('css/admin_blade.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @media (min-width: 100px){
            h1 {
                font-size: 16px;
                font-weight: bold;
            }

            h2 {
                font-size: 11px;
                font-weight: bold;
            }

            h3 {
                font-size: 9px;
                font-weight: bold;
            }

            h4 {
                text-transform: uppercase;
                font-size: 9px;
            }

            h5 {
                font-size: 6px;
            }
        }

        @media (min-width: 640px){
            h1 {
                font-size: 16px;
                font-weight: bold;
            }

            h2 {
                font-size: 12px;
                font-weight: bold;
            }

            h3 {
                font-size: 10px;
                font-weight: bold;
            }

            h4 {
                text-transform: uppercase;
                font-size: 10px;
            }

            h5 {
                font-size: 6px;
            }
        }

        @media (min-width: 1080px){
            h1 {
                font-size: 18px;
                font-weight: bold;
            }

            h2 {
                font-size: 14px;
                font-weight: bold;
            }

            h3 {
                font-size: 12px;
                font-weight: bold;
            }

            h4 {
                text-transform: uppercase;
                font-size: 10px;
            }

            h5 {
                font-size: 8px;
            }
        }

        table {
            width: 100%;
        }

        table td {
            vertical-align: top;
            line-height: 14px;
        }

        .withBorder td {
            border: 0.1rem solid black;
        }

        table tr {
            align-items: center;
            justify-content: center;
            vertical-align: top;
            line-height: 15px
        }

        tr {
            width: 100%;
        }

        .border {
            border: 1px solid black;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        .grey {
            background-color: #D9D9D9;
        }

        .clausulas{
            font-size: 10px;
        }

        .p {
            margin-left: 30px;
        }
        .clausulas{
            font-size: 14px;
        }
    </style>
<head>
<body class="bg-agil bg-1/2 bg-teal-700">

    <div class="h-screen flex flex-col justify-center items-center p-1" x-data="handle()">
        <div class="max-h-11/12 p-5 flex flex-col justify-center rounded-lg bg-gray-100 w-full sm:w-10/12 md:w-8/12 lg:x-8/12 xl:w-6/12">
            @foreach ($successAlerts ?? [] as $alert)
                <div class="w-full mb-1 bg-green-200 flex items-center border-l-4 border-green-600 text-green-800 p-4 rounded-t-lg rounded-b-md text-xs sm:text-base"  role="alert">
                    <p class="font-bold mr-2">Sucesso:</p>
                    <p>{{ $alert }}</p>
                </div>
            @endforeach


            @foreach ($warningAlerts ?? [] as $alert)
                <div class="w-full mb-1 bg-yellow-300 flex items-center border-l-4 border-yellow-600 text-yellow-900 p-4 rounded-t-lg rounded-b-md text-xs sm:text-base"  role="alert">
                    <p class="font-bold mr-2">Atenção:</p>
                    <p>{{ $alert }}</p>
                </div>
            @endforeach

             @if(isset($contrato))
            <div class="my-4 p-4 sm:p-6 md:px-6 lg:px-14 bg-white w-full shadow-sm rounded-md overflow-y-scroll no-scrollbar">
                @yield('content')
            </div>

            <div class="max-h-2/12 w-full bg-white text-orange-700 p-4 rounded-b-lg rounded-t-md flex justify-between items-center text-xs sm:text-base">
                <div>
                    <p class="font-bold pb-2">Assinatura:</p>
                    <input x-ref="check" @click="setShowNextButton()" type="checkbox" class="form-checkbox cursor-pointer" id="check">
                    <label class="ml-2 cursor-pointer" for="check">Confirmo e aceito os termos do contrato</label>
                </div>

                <template x-if="showNextButton">
                    <a class="btn h-4/5 bg-teal-600 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded" href="{{ route($linkAssinatura, [($id_proposta ?? 0), ($id_pessoa_assinatura ?? 0)]) }}">
                        Próximo
                    </a>
                </template>
            </div>
            @endif

            @if($pdfContrato)
                @yield('content-pdf-contrato')
            @endif
        </div>
    </div>
    <script src="{{ mix('js/app_blade.js') }}"></script>
    <script>
        function handle() {
            return {
                showNextButton: false,
                setShowNextButton() {
                    this.showNextButton = this.$refs.check.checked;
                },
            }
        }
    </script>
</body>
</html>
