<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ mix('css/app_vue.css') }}">
<head>
<body>
    <div class="h-screen flex justify-center items-center bg-gradient-to-r from-green-500 to-green-600">
        <div class="h-5/6 overflow-y-scroll p-12 bg-white w-5/12 shadow-sm sm:rounded-lg">
            @yield('content')
        </div>
    </div>
    <!-- <script src="{{ mix('js/app_vue.js') }}"></script> -->
</body>
</html>
