<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ localization()->getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ $header->favicon }}">
    {!! SEO::generate() !!}

    <x-admin.headerAssets />
    
    @livewireStyles
</head>
<body class="antialiased bg-gray-100 {{ Cookie::get('theme_mode', $general->default_theme_mode) }}">
    <div class="wrapper">
        <div class="main-content position-relative border-radius-lg ps">
            <div class="page-body">
                <div class="container-fluid">
                    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
                        <div class="text-center mb-4">
                            @switch( Cookie::get('theme_mode', $general->default_theme_mode) )
                                @case('theme-dark')
                                    <img src="{{ $header->logo_dark }}" height="40" alt="{{ __($siteTitle) }}" class="navbar-brand-image mb-3">
                                    @break
                                @case('theme-light')
                                    <img src="{{ $header->logo_light }}" height="40" alt="{{ __($siteTitle) }}" class="navbar-brand-image mb-3">
                                    @break
                                @default
                                    <img src="{{ $header->logo_light }}" height="40" alt="{{ __($siteTitle) }}" class="navbar-brand-image mb-3">
                            @endswitch
                        </div>

                        <div class="row">
                            <div class="col-12">
                                @livewire('admin.update')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin.footerAssets />
    
    @livewireScripts
</body>
</html>
