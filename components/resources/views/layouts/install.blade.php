<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ __('SumoSEOTools Setup Wizard') }}</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
        <link type="text/css" href="{{ asset('assets/css/main.ltr.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/install.css') }}" rel="stylesheet" />
        @livewireStyles
    </head>
    <body class="bg-gray-100">

        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="card shadow">
                                
                                <div class="card-header p-0 d-block border-0">
                                    <div class="header">
                                        <h1 class="header-title">

                                            @switch( Route::currentRouteName() )
                                                @case( 'sw_install' )
                                                        {{ __('Welcome!') }}
                                                    @break

                                                @case( 'sw_requirements' )
                                                        {{ __('Server Requirements') }}
                                                    @break

                                                @case( 'sw_database' )
                                                        {{ __('Database Configuration') }}
                                                    @break
                                                    
                                                @case( 'sw_account' )
                                                       {{ __('Create An Admin Account') }}
                                                    @break

                                                @case( 'sw_import' )
                                                        {{ __('Import Demo Content') }}
                                                    @break

                                                @case( 'sw_finished' )
                                                        {{ __('Your Website is Ready!') }}
                                                    @break

                                                @default
                                            @endswitch
                                            
                                        </h1>
                                    </div>

                                    <ul class="step">
                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_finished') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-check"></i>
                                            </a>
                                        </li>

                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_import') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-sync-alt"></i>
                                            </a>
                                        </li>

                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_account') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-user"></i>
                                            </a>
                                        </li>

                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_database') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-server"></i>
                                            </a>
                                        </li>

                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_requirements') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-list"></i>
                                            </a>
                                        </li>

                                        <li class="step-divider"></li>
                                        <li class="step-item {{ Route::is('sw_install') ? 'active' : '' }}">
                                            <a href="javascript:void(0)">
                                                <i class="step-icon fas fa-home"></i>
                                            </a>
                                        </li>
                                        <li class="step-divider"></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                   {{ $slot }}
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @livewireScripts
    </body>
</html>
