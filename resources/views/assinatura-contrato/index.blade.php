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
    <div class="h-screen flex justify-center items-center p-5">
        <div class="max-h-11/12 p-1 xsm:p-4 sm:p-6 md:p-6 lg:p-6 bg-white w-full xsm:w-full sm:w-10/12 md:w-8/12 lg:w-1/2 shadow-sm rounded-lg  overflow-y-scroll no-scrollbar">
            @yield('content')
        </div>
    </div>
    <!-- <script src="{{ mix('js/app_vue.js') }}"></script> -->
</body>
</html>
