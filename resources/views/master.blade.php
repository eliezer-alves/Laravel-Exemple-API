<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/icons/default_agil_icon.png') }}" type="image/ico" />

    <title>Ágil - @yield('title')</title>
        <!-- Reset CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/reset.css') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/template_dependences/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/template_dependences/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/template_dependences/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets/template_dependences/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/template_dependences/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/template_dependences/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/template_dependences/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/template_dependences/build/css/custom.min.css') }}" rel="stylesheet">

    <!-- DataTables Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/template_dependences/datatables/css/jquery.dataTables.css') }}">

    <!-- SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- TGGLE BUTTONS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Others Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css?v=1') }}">

    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>

    <!-- jQuery -->
    <script src="{{ url('assets/template_dependences/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Agil -->
    <script src="{{ url('assets/js/agil.js') }}"></script>

    <!-- INPUTMASK -->
    <script src="{{ url('assets/js/inputmask.js') }}"></script>

    <!-- BOOTSTRAP -->
    <script src="{{ url('assets/template_dependences/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- SELECT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
    <!-- SWL ALERTS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- FastClick -->
    <script src="{{ url('assets/template_dependences/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ url('assets/template_dependences/vendors/nprogress/nprogress.js') }}"></script>  
    <script src="{{ url('assets/template_dependences/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ url('assets/template_dependences/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ url('assets/template_dependences/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ url('assets/template_dependences/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('assets/template_dependences/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- VALIDATE JS -->  
    <script src="{{ url('assets/js/jquery.validate.js') }}"></script>
    <!-- LOTTIE FILES -->  
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <!-- DataTables Theme Scripts -->
    <script type="text/javascript" language="javascript" src="{{ url('assets/template_dependences/datatables/js/jquery.dataTables.js') }}"></script>  
    <script type="text/javascript" language="javascript" src="{{ url('assets/template_dependences/datatables/js/utils/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/ui.datepicker-pt-BR.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/jquery.mask.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/dataTables.fixedHeader.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/buttons.flash.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/template_dependences/datatables/js/utils/date-euro.js') }}"></script>
</html>