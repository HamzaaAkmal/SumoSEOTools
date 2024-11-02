<div>

    <form wire:submit.prevent="onUpdateCaptcha" class="row">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <!-- Begin:reCAPTCHA v3 -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="text-white mb-0">{{ __('reCAPTCHA v2') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-google-recaptcha-v2-keys/" target="_blank" class="text-white">{{ __('How to get Google reCAPTCHA v2 Keys') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover settings">
                            <tr>
                                <td class="align-middle w-25"><label for="captcha_status" class="fw-bold">Captcha Status</label></td>
                                <td class="align-middle">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="captcha_status">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle w-25"><label for="captcha_for_registered" class="fw-bold">Captcha for Registered Users</label></td>
                                <td class="align-middle">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="captcha_for_registered">
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="align-middle"><label for="username" class="fw-bold">{{ __('Site Key') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="site_key">
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"><label for="password" class="fw-bold">{{ __('Secret Key') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="secret_key">
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:reCAPTCHA v3 -->

        <div class="form-group">
            <button class="btn bg-gradient-primary float-end mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onUpdateCaptcha">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>

    </form>

</div>
