<!-- Navbar Light -->
<nav class="navbar navbar-expand-lg {{ ( Cookie::get('theme_mode', $general->default_theme_mode) == 'theme-light') ? 'navbar-light bg-white' : '' }} @if ($header->sticky_header)position-sticky z-index-sticky top-0 bg-default @endif">
  <div class="container">
    <a class="navbar-brand logo-image" title="{{ __($siteTitle) }}" href="{{ route('home') }}">

        @if ( !empty($header->logo_light) )

            @switch( Cookie::get('theme_mode', $general->default_theme_mode) )
                @case('theme-dark')
                    <img src="{{ $header->logo_dark }}" width="200" height="35" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
                    @break

                @case('theme-light')
                    <img src="{{ $header->logo_light }}" width="200" height="35" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
                    @break

                @default
                    <img src="{{ $header->logo_light }}" width="200" height="35" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
            @endswitch
            
        @else
          {{ $siteTitle }}
        @endif
    </a>

    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>

    <div class="navbar-nav flex-row order-lg-last m-auto">
            @if ( $general->search_box_status )
                <div class="m-auto">
                    @livewire('public.search-box')
                </div>
            @endif

            @if ( $general->theme_mode )
                <div class="nav-item m-auto">
                    @if ( empty( Cookie::get('theme_mode', $general->default_theme_mode) ) || Cookie::get('theme_mode', $general->default_theme_mode) === 'theme-light' )
                        <button class="btn btn-icon btn-icon-only mb-0 me-2 bg-white btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable dark mode') }}" data-bs-original-title="{{ __('Enable dark mode') }}" title="{{ __('Enable dark mode') }}">
                            <i class="fas fa-moon text-warning"></i>
                        </button>
                    @else
                        <button class="btn btn-icon btn-icon-only mb-0 me-2 bg-white btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable light mode') }}" data-bs-original-title="{{ __('Enable light mode') }}" title="{{ __('Enable light mode') }}">
                            <i class="fas fa-sun text-warning"></i>
                        </button>
                    @endif
                </div>
            @endif

            <!-- Begin::Navbar Right -->
            @foreach($menus as $key => $value)

                @if ( $value['type'] == 'button' )

                  @if( count($value['children']) )
                        <div class="nav-item dropdown">
                            <a class="btn btn-icon dropdown-toggle me-2 {{ $value['class'] }}" href="#navbarDropdownMenuButton{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} icon"></i>
                               @endif
                               {{ __($value['text']) }}
                            </a>

                            <x-public.menu :childs="$value['children']" />
                        </div>

                  @else

                    <div class="nav-item m-auto">
                        <a class="btn btn-icon mb-0 me-2 {{ $value['class'] }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}" target="{{ $value['target'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} icon"></i>
                           @endif
                          {{ __($value['text']) }}
                        </a>
                    </div>

                  @endif

              @endif

            @endforeach
            <!-- End::Navbar Right -->

            <!-- Begin::Login -->
            @php
                $loginPage = \App\Models\Admin\AuthPages::where('name', 'Login')->first();
                $profilePage = \App\Models\Admin\AuthPages::where('name', 'Profile')->first();
                $registerPage = \App\Models\Admin\AuthPages::where('name', 'Register')->first();
            @endphp

            @auth
                @include('components.public.userMenu', ['user' => Auth::user(), 'profilePage' => $profilePage])
            @else

               @if ($loginPage && $loginPage->status)
                <div class="nav-item me-2">
                    <a class="btn {{ ($registerPage && $registerPage->status) ? 'btn-default' : 'btn-success' }} mb-0 border-0 shadow-none" href="{{ route('login')}}">{{ __('Login') }}</a>
                </div>
                @endif

               @if ($registerPage && $registerPage->status)
                    <div class="nav-item">
                        <a class="btn bg-gradient-primary mb-0" href="{{ route('register')}}">{{ __('Register') }}</a>
                    </div>
                @endif
            @endauth
            <!-- End::Login -->
    </div>

    <div class="collapse navbar-collapse" id="navigation">
      
        <ul class="navbar-nav navbar-nav-hover mx-auto">

            <!-- Begin::Navbar Left -->
            @foreach($menus as $key => $value)

                @if ( $value['type'] == 'link' )

                  @if( count($value['children']) )
                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="#navbarDropdownMenuChild" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} me-2"></i>
                               @endif
                               {{ __($value['text']) }}

                                @if( Cookie::get('theme_mode') === 'theme-light' )
                                    <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1" width="10" height="7">
                                @else
                                    <img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow ms-1" width="10" height="7">
                                @endif
                               
                            </a>

                            <x-public.menu :childs="$value['children']" />
                        </li>

                  @else

                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}" target="{{ $value['target'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} me-2"></i>
                           @endif
                          {{ __($value['text']) }}
                        </a>
                    </li>

                  @endif

                @endif

            @endforeach
            <!-- End::Navbar Left -->

            <!-- Begin:Lang Menu -->
            @if ( $general->language_switcher == true )

              @php
                $mobileLangMenu = '';
              @endphp

                <li class="nav-item dropdown mx-2 lang-menu" wire:ignore>
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" data-bs-toggle="dropdown" href="#navbar-base">
                        <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" alt="{{ localization()->getCurrentLocale() }}" width="16" height="10" class="lang-image me-2 my-auto"> 
                        {{ localization()->getCurrentLocaleNative() }}
                            @if( Cookie::get('theme_mode') === 'theme-light' )
                                <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow-dark" class="arrow ms-1" width="10" height="7">
                            @else
                                <img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow ms-1" width="10" height="7">
                            @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-language px-2">
                        <div class="scrollable-lang">
                           @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                               <li>
                                  <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}">
                                    <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" alt="{{ $properties->key() }}" width="16" height="10" class="lang-image me-2 my-auto"> {{ $properties->native() }}
                                  </a>
                              </li>
                           @endforeach
                       </div>
                    </ul>
                </li>
              
            @endif
            <!-- End:Lang Menu -->
        </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->