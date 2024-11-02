<main class="main-content mt-0 ps">
    <section id="login-page">
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">{{ __('Sign In') }}</h4>
                                <p class="mb-0">{{ __('Enter your email and password to sign in') }}</p>
                            </div>

                            <div class="card-body">
                                <form role="form" wire:submit.prevent="onLogin">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    
                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    <div class="mb-3">
                                        <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model.defer="email" required autofocus />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" type="password" wire:model.defer="password" required />
                                    </div>

                                    <div class="d-flex align-items-start mb-3">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" type="checkbox" wire:model.defer="remember_me" id="remember_me" />
                                            <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>
                                        </div>

                                        <div class="ms-auto">
                                            @if ( $this->forgot_password_status )
                                                <small class="form-label-description">
                                                  <a href="{{ route('password.forgot') }}">{{ __('Forgot password?') }}</a>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if ( \App\Models\Admin\General::first()->captcha_status )
                                      <x-public.recaptcha />
                                    @endif

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mb-0" wire:loading.attr="disabled">
                                            <span>
                                              <div wire:loading wire:target="onLogin">
                                                <x-loading />
                                              </div>
                                              <span>{{ __('Sign in') }}</span>
                                            </span>
                                        </button>
                                    </div>

                                    @if ( \App\Models\Admin\General::first()->google_login_status || \App\Models\Admin\General::first()->facebook_login_status )
                                        <div class="text-center my-3">{{ __('or') }}</div>
                                        <div class="row">
                                            @if ( \App\Models\Admin\General::first()->google_login_status )
                                                <div class="col-12">
                                                    <a class="btn btn-danger w-100 mb-2" href="{{ url('auth/google') }}">
                                                        <i class="fab fa-google icon"></i>
                                                        {{ __('Login with Google') }}
                                                    </a>
                                                </div>
                                            @endif

                                            @if ( \App\Models\Admin\General::first()->facebook_login_status )
                                                <div class="col-12">
                                                    <a class="btn btn-facebook w-100 mb-2" href="{{ url('auth/facebook') }}">
                                                        <i class="fab fa-facebook icon"></i>
                                                        {{ __('Login with Facebook') }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                </form>
                            </div>

                            @if ( $this->forgot_password_status )
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        {{ __('Don\'t have account yet?') }} 
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">{{ __('Sign up') }}</a>
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>
                    
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden auth-background">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative z-index-1">{{ __('Welcome back!') }}</h4>
                            <p class="text-white position-relative z-index-1">{{ __('Login with your email address and password to keep connected with us.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
