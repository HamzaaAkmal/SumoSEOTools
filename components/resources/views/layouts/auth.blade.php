<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ localization()->getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ $header->favicon }}">

        {!! SEO::generate() !!}

        @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
          <link rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}">
        @endforeach

        @if ( $general->page_load )
            <!-- Pace -->
            <script src="{{ asset('assets/js/pace.min.js') }}" defer></script>
        @endif

        @if ( $general->adblock_detection )
          <!-- Sweet Alert 2 -->
          <link rel="preload" href="{{ asset('assets/css/sweetalert2.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
          <noscript><link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}"></noscript>
        @endif

        <!-- Font Awesome -->
        <link rel="preload" href="{{ asset('assets/css/fontawesome.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}"></noscript>

        <!-- Nucleo Icons -->
        <link rel="preload" href="{{ asset('assets/css/nucleo-icons.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}"></noscript>
        
        <link rel="preload" href="{{ asset('assets/css/nucleo-svg.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}"></noscript>

        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- Popper -->
        <script src="{{ asset('assets/js/popper.min.js') }}" defer></script>

        <!-- Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}" defer></script>

        <!-- Smooth Scrollbar -->
        <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}" defer></script>

        <!-- Theme CSS -->
        <link type="text/css" href="{{ asset('assets/css/main.'.localization()->getCurrentLocaleDirection().'.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('assets/css/custom.'.localization()->getCurrentLocaleDirection().'.css') }}" rel="stylesheet">
        
        @if ( !empty($general->font_family) )

          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ urlencode($general->font_family) }}&display=swap">

          <style>
            body, .card .card-body {
              font-family: {{ $general->font_family }} !important;
            }
          </style>

        @endif

        @if ( $advanced->header_status && $advanced->insert_header != null )
          {!! $advanced->insert_header !!}
        @endif

        @livewireStyles

    </head>
    <body class="antialiased {{ Cookie::get('theme_mode', $general->default_theme_mode) }}">

        @if ( $advanced->body_status && $advanced->insert_body != null )
          {!! $advanced->insert_body !!}
        @endif

      @if ( $general->maintenance_mode && ( !Auth::check() || Auth::user()->is_admin != 1 ) && !Route::is('login') && !Route::is('admin.login') )
          
          @livewire('public.maintenance')

      @else

         <div class="page">

            <x-public.navbar :header="$header" :siteTitle="$siteTitle" :menus="$menus" :general="$general" />

            <!-- Begin::page-wrapper -->
            <div class="page-wrapper">
                  <!-- Begin::page-content -->
                  <div class="page-content">

                      @if(Auth::user() && \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status && Auth::user()->email_verified_at == null)
                          <div class="alert alert-important alert-warning alert-dismissible mb-0 text-center rounded-0" role="alert">
                            {{ __('Your email address is not verified.') }} <a href="{{ route('verify.email') }}" class="alert-link text-decoration-underline">{{ __('Verify it here!') }}</a>
                          </div>
                      @endif

                      <!-- Begin::page-content -->
                          @switch(true)
                              @case( Route::is('login') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status )
                                          @livewire('public.auth.login')
                                      @else
                                          @include('errors.disabled', ['message' => 'Login'])
                                      @endif
                                  @break

                              @case( Route::is('admin.login') )
                                      @livewire('public.auth.admin-login')
                                  @break

                              @case( Route::is('register') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Register')->first()->status )
                                          @livewire('public.auth.register')
                                      @else
                                          @include('errors.disabled', ['message' => 'Register'])
                                      @endif
                                  @break

                              @case( Route::is('password.forgot') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Forgot Password')->first()->status )
                                          @livewire('public.auth.forgot-password')
                                      @else
                                          @include('errors.disabled', ['message' => 'Forgot Password'])
                                      @endif
                                  @break

                              @case( Route::is('password.reset') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Reset Password')->first()->status )
                                          @livewire('public.auth.reset-password', [
                                                    'token' => request()->token,
                                                    'email' => request()->email
                                                  ])
                                      @else
                                          @include('errors.disabled', ['message' => 'Reset Password'])
                                      @endif
                                  @break

                              @case( Route::is('verify.email') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status )
                                          @livewire('public.auth.verify-email')
                                      @else
                                          @include('errors.disabled', ['message' => 'Verify Email'])
                                      @endif
                                  @break

                              @case( Route::is('user.profile') )
                                      @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status )
                                          @livewire('public.auth.profile')
                                      @else
                                          @include('errors.disabled', ['message' => 'Profile'])
                                      @endif
                                  @break

                              @default
                          @endswitch
                      <!-- End::page-content -->
                  </div>
                  <!-- End::page-content -->
            </div>
            <!-- End::page-wrapper -->

            <x-public.footer :footer="$footer" :general="$general" :socials="$socials" />

            <!-- Theme JS -->
            <script src="{{ asset('assets/js/main.min.js') }}" defer></script>

            @if ( $general->lazy_loading )
              <script src="{{ asset('assets/js/lazysizes.min.js') }}" async></script>
              <script src="{{ asset('assets/js/ls.unveilhooks.min.js') }}" async></script>
            @endif

            @if ( $general->search_box_status )
              <script>
                const searchIcon = document.getElementById('search-icon');
                const searchBox = document.getElementById('search-box');

                // Show/hide search box
                searchIcon.addEventListener('click', function () {
                  if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                    searchBox.style.display = 'block';
                  } else {
                    searchBox.style.display = 'none';
                  }
                });

                // Hide search box when user clicks outside of it
                document.addEventListener('click', function (event) {
                  const isClickInsideSearchBox = searchBox.contains(event.target);
                  const isClickInsideSearchIcon = searchIcon.contains(event.target);
                  if (!isClickInsideSearchBox && !isClickInsideSearchIcon) {
                    searchBox.style.display = 'none';
                  }
                });
              </script>
            @endif

            @if ( $general->back_to_top )
                <!-- Scroll back to top -->
                <div id="backtotop"> 
                    <a href="#" class="backtotop"></a> 
                </div>

                <script type="text/javascript"> 
                    jQuery(document).ready(function ($) {
                        $("#backtotop").hide(); 
                        $(window).scroll(function () { 
                            if ($(this).scrollTop() > 500) { 
                                $('#backtotop').fadeIn(); 
                            } else { 
                                $('#backtotop').fadeOut(); 
                            } 
                        });   
                    });

                    jQuery('.backtotop').click(function () { 
                        jQuery('html, body').animate({ 
                            scrollTop: 0 
                        }, 'slow'); 
                    });
                </script> 
                <!-- End of Scroll back to top -->
            @endif

            @if ( $general->adblock_detection )

              <!-- Sweetalert2 -->
              <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

              <script>
              (function( $ ) {
                "use strict";

                    document.addEventListener("DOMContentLoaded", function () {
                      setTimeout(() => {
                        const el = document.querySelector(".ad-banner");

                        if (el && el.offsetHeight === 0) {
                          Swal.fire({
                            title: "You&#039;re blocking ads",
                            text: "Our website is made possible by displaying online ads to our visitors. Please consider supporting us by disabling your ad blocker.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "I have disabled Adblock",
                            cancelButtonText: "No, thanks!",
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.reload();
                            }
                          });
                        }
                      }, 100);
                    });

              })( jQuery );
              </script>

            @endif

            @if (Cookie::get('cookies') == null)

              @if ( $notice->status )

                      <div class="row cookies-wrapper alert {{ $notice->background }}" role="alert">
                        <div class="col-md-12 col-lg-{{ ($notice->button == true) ? '10' : '12'}} my-auto {{ $notice->align }}">
                          {!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}
                        </div>

                        @if ( $notice->button == true)
                          <div class="col-md-12 col-lg-2 my-auto text-end p-2">
                              <button id="acceptCookies" target="_blank" class="btn btn-sm bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                          </div>
                        @endif
                        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
                      </div>

                  <script>
                     (function( $ ) {
                        "use strict";

                            jQuery("#acceptCookies").click(function(){
                                jQuery.ajax({
                                    type : 'get',
                                    url : '{{ url('/') }}/cookies/accept',
                                    success: function(e) {
                                        jQuery('.cookies-wrapper').remove();
                                    }
                                });
                            });

                    })( jQuery );
                  </script>
              @endif

            @endif

            @if ( $general->theme_mode )
              <script>
                 (function( $ ) {
                    "use strict";

                        jQuery(".btn-toggle-mode").click(function(){
                            jQuery.ajax({
                                type : 'get',
                                url : '{{ url('/') }}/theme/mode',
                                success: function(e) {
                                    window.location.reload();
                                }
                            });
                        });

                })( jQuery );
              </script>
            @endif
            
            @if ( $advanced->footer_status && $advanced->insert_footer != null )
              {!! $advanced->insert_footer !!}
            @endif

          </div>

          @livewireScripts

      @endif

    </body>
</html>