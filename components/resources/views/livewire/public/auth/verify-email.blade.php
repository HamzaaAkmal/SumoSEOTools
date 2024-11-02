<main class="main-content mt-0 ps">
    <section id="verify-email-page">
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card mb-md-8">
                            <div class="card-header pb-0">
                                <h4 class="font-weight-bolder text-center py-2">{{ __('Verify it\'s you') }}</h4>
                                <p class="mb-0">{{ __('Could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                            </div>
                            <div class="card-body">

                                <form role="form" wire:submit.prevent="onResendEmail">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    @if ( \App\Models\Admin\General::first()->captcha_status )
                                      <x-public.recaptcha />
                                    @endif

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100" wire:loading.attr="disabled">
                                            <span>
                                                <div wire:loading wire:target="onResendEmail">
                                                    <x-loading />
                                                </div>
                                                <span>{{ __('Resend Verification Email') }}</span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>