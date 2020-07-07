<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
        <link href="{{ asset('public/css/fonts-nunito.css') }}" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/css/app.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
            .btn {
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                font-weight: 700;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border: 2px solid transparent;
                padding: 0px 4px;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 3px;
                -webkit-transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, -webkit-box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), -webkit-transform 0.2s cubic-bezier(0.35, 0, 0.25, 1);
                transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, -webkit-box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), -webkit-transform 0.2s cubic-bezier(0.35, 0, 0.25, 1);
                -o-transition: box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), transform 0.2s cubic-bezier(0.35, 0, 0.25, 1), background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
                transition: box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), transform 0.2s cubic-bezier(0.35, 0, 0.25, 1), background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
                transition: box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), transform 0.2s cubic-bezier(0.35, 0, 0.25, 1), background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, -webkit-box-shadow 0.3s cubic-bezier(0.35, 0, 0.25, 1), -webkit-transform 0.2s cubic-bezier(0.35, 0, 0.25, 1);
            }
            .btn-info {
                color: #FFF;
                background-color: #17a2b8;
                border-color: #17a2b8;
            }
            .btn-danger {    
                color: #FFF;
                background-color: #dc3545;
                border-color: #dc3545;
            }
            .btn-custom {    
                color: #000;
                background-color: cyan;
                border-color: aquamarine;
            }
        </style>
        @section('styles')
        @show
    </head>
    <body>
        <div class="flex-center position-ref full-height position-relative">

            <button class="btn btn-info px-1 py-0" title="Back" onclick="window.history.go(-1)" autocomplete="off" style="display: flex; font-size: 26px;">&#x1f6fa;<div>&#x1f3c3;</div></button>

            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
            <form id="logout-form" class="" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger px-1 py-0" title="Logout" autocomplete="off" style="display: flex; font-size: 26px;">&#x1f6aa;<div style="transform: rotateY(180deg);">&#x1f3c3;</div></button>
            </form>
            <button type="button" class="btn btn-custom px-1 py-0" title="Home" onclick="window.location.replace('{{ route('admin.home') }}')" autocomplete="off" style="bottom: 0; position: absolute;"><i class="fa fa-home m-0 p-0" style="font-size: 50px !important; color: #025555;"></i></button>
        </div>
    </body>
    @section('scripts')
    @show
</html>
