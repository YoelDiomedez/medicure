<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }} | @yield('pagetitle')</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Sistema para la gestión de Historiales Médicos" name="description" />
        <meta content="Yoel Diomedez" name="author" />
        @section('styles')
        <!-- BEGIN GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
        <!-- END GLOBAL MANDATORY THEME PAGE LEVEL STYLES -->
        @show
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGO -->
        <div  style="text-align: center;">
            <a href="/">
                <img src="{{ asset('img/medicure-logo-3.png') }}" alt="Logo" /> 
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top: 0px;">

            @yield('content')
            
        </div>
        <div class="copyright font-white"> 
            © {{ date('Y') }} {{ config('app.owner', 'Yoel Diomedez Apps') }}
        </div>
        <!-- BEGIN CORE THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/auth.js') }}"></script>
        <script>
            $(document).ready( function () {
                $.backstretch(
                    [
                        "{{ asset('img/background/1.jpg') }}", 
                        "{{ asset('img/background/2.jpg') }}", 
                        "{{ asset('img/background/3.jpg') }}", 
                        "{{ asset('img/background/4.jpg') }}"
                    ],
                    {
                        fade: 1e3,
                        duration: 8e3
                    }
                )
            })
        </script>
        <!-- END THEME GLOBAL SCRIPTS -->
        @stack('scripts')
    </body>
</html>