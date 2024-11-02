<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ localization()->getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ \App\Models\Admin\Header::first()->favicon }}">

        <title>{{ __('Error 404 (Not Found)') }} - {{ env('APP_NAME') }}</title>
        <meta name="robots" content="follow, noindex"/>
        
        @if ( \App\Models\Admin\General::first()->page_load )
            <!-- Pace -->
            <script src="{{ asset('assets/js/pace.min.js') }}"></script>
        @endif

        <!-- Theme CSS -->
        <link type="text/css" href="{{ asset('assets/css/main.'.localization()->getCurrentLocaleDirection().'.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('assets/css/custom.'.localization()->getCurrentLocaleDirection().'.css') }}" rel="stylesheet">
        
        @if ( !empty(\App\Models\Admin\General::first()->font_family) )

          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ \App\Models\Admin\General::first()->font_family }}">

          <style>
            body, .card .card-body {
              font-family: {{ \App\Models\Admin\General::first()->font_family }} !important;
            }
          </style>

        @endif

    </head>
    <body class="antialiased {{ Cookie::get('theme_mode') }}">

        @if ( \App\Models\Admin\General::first()->maintenance_mode && ( !Auth::check() || Auth::user()->is_admin != 1 ) && !Route::is('login') && !Route::is('admin.login') )
          
          @livewire('public.maintenance')

        @else
          <div class="main-content mt-0 ps">
              <div class="page-header min-vh-100" style="background-image: url('{{ asset('assets/img/404.svg') }}');">
                 <div class="container">
                    <div class="row justify-content-center mx-auto text-center">
                        <h1 class="display-1 text-bolder text-gradient text-primary">{{ __('Error 404') }}</h1>
                        <h2>{{ __('Oops… You just found an error page') }}</h2>
                        <p class="lead">{{ __('We are sorry but the page you are looking for was not found!') }}</p>
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn bg-gradient-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <line x1="5" y1="12" x2="11" y2="18"></line>
                                    <line x1="5" y1="12" x2="11" y2="6"></line>
                                </svg>
                                {{ __('Go to Homepage') }}
                            </a>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        @endif

    </body>
</html>