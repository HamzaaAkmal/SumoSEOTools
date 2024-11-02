<main class="main-content mt-0 ps">
    <section id="register-page">
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">{{ __('Sign Up') }}</h4>
                                <p class="mb-0">{{ __('Enter your email and password to register') }}</p>
                            </div>
                            <div class="card-body">
                                
                                <form role="form" wire:submit.prevent="onRegister">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Full name') }}</label>
                                        <input class="form-control @error('fullname') is-invalid @enderror" placeholder="{{ __('Enter your name') }}" type="text" wire:model.defer="fullname" required autofocus />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model.defer="email" required />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        <div class="input-group input-group-flat">
                                            <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" type="password" wire:model.defer="password" required />
                                        </div>
                                    </div>

                                    @if ( \App\Models\Admin\General::first()->captcha_status )
                                      <x-public.recaptcha />
                                    @endif

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mb-0" wire:loading.attr="disabled">
                                            <span>
                                              <div wire:loading wire:target="onRegister">
                                                <x-loading />
                                              </div>
                                              <span>{{ __('Sign up') }}</span>
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
                                                        {{ __('Connect with Google') }}
                                                    </a>
                                                </div>
                                            @endif

                                            @if ( \App\Models\Admin\General::first()->facebook_login_status )
                                                <div class="col-12">
                                                    <a class="btn btn-facebook w-100 mb-2" href="{{ url('auth/facebook') }}">
                                                        <i class="fab fa-facebook icon"></i>
                                                        {{ __('Connect with Facebook') }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </form>
                            </div>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    {{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">{{ __('Sign in') }}</a>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div
                            class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden auth-background">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative z-index-1">{{ __('Hello, Friend!') }}</h4>
                            <p class="text-white position-relative z-index-1">{{ __('Create an account to start journey with us.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>