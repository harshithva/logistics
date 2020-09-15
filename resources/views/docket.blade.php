<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gurukal - Docket</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <script src="{{asset('css/app.css')}}"></script>

    <style>
        p {
            color: black !important;
        }

        #qrcode {
            height: 120px !important;
            width: 120px !important;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="container-fluid">

            <div class="row mt-3 mb-3 ml-3 d-print-none">
                <div class="col-6"></div>
                <div class="col-3"></div>
                <div class="col-3">
                    <a class="btn btn-primary text-white" onclick="javascript:window.print()">
                        <i class="fas fa-print"></i> Print
                    </a>

                </div>
            </div>

            <Docket :shipment="{{ json_encode($shipment) }}" copy="ORIGINAL"></Docket>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->


    <!-- Page level custom scripts -->


    <script src="{{asset('js/app.js')}}"></script>

</body>