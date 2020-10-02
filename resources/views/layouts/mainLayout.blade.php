<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Norma invima</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap-4.5.2-dist/css/bootstrap.min.css')}}">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/toastr/toastr.min.css')}}" rel="stylesheet" />
    @yield('estilos')
    @laravelPWA
</head>
<body>
    @yield('contenido')
    <script src="{{asset('assets/Jquery/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/bootstrap-notify-3.1.3/bootstrap-notify.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="{{asset('assets/bootstrap-4.5.2-dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>
    @yield('scripts')
</body>
</html>