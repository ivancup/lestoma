<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @include('admin.shared.head')

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- sidebar menu -->
    @include('admin.shared.sidebar')
    <!-- /sidebar menu -->

        <!-- top navigation -->
    @include('admin.shared.header')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>UNIVERSIDAD DE CUNDINAMARCA
                        </h3>
                        
                    </div>
                    <div class="title_right">
                        <h3 id="valor_sede">
                            <i class="fas fa-sync" aria-hidden="true" onclick="mostrarSedes('{{route('admin.sedes.mostrar')}}')"></i> Sede:
                            <small>{{ session()->has('sede')? session()->get('sede'):'Ninguna sede seleccionada.' }}</small>
                        </h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @include('admin.shared.mostrarSedes')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('admin.shared.footer')
    <!-- /footer content -->
    </div>
</div>
@include('admin.shared.scripts')

<!-- Functions for content -->
@stack('functions')
</body>

</html>