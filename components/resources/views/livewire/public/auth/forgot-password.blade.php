<main class="main-content mt-0 ps">
    <section id="reset-password-page">
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card mb-md-8">
                            <div class="card-header pb-0">
                                <h4 class="font-weight-bolder text-center py-2">{{ __('Reset Password') }}</h4>
                                <p class="mb-0">{{ __('Please enter your email address. You will receive a link to create a new password via email.') }}</p>
                            </div>
                            <div class="card-body">
                                <form role="form" wire:submit.prevent="onForgotPassword">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" wire:model.defer="token">

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model.defer="email" required autofocus />
                                    </div>

                                    @if ( \App\Models\Admin\General::first()->captcha_status )
                                      <x-public.recaptcha />
                                    @endif

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100" wire:loading.attr="disabled">
                                            <span>
                                              <div wire:loading wire:target="onForgotPassword">
                                                <x-loading />
                                              </div>
                                              <span>{{ __('Send') }}</span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="text-sm mx-auto">
                                    {{ __('Back to') }}
                                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">{{ __('Sign in') }}</a>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>