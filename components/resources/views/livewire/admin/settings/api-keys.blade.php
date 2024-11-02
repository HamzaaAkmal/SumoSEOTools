<div>

    <form wire:submit.prevent="onUpdateAPIKeys" class="row">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <!-- Begin:Facebook -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="text-white mb-0">{{ __('Facebook') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-facebook-cookies/" target="_blank" class="text-white">{{ __('How to get Facebook Cookies') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover settings">
                            <tr>
                                <td class="align-middle"><label for="facebook_cookies" class="form-label">{{ __('Cookies') }}</label></td>
                                <td class="align-middle">
                                    <textarea class="form-control" wire:model.defer="facebook_cookies" rows="5"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Facebook -->

        <!-- Begin:Moz -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="card-title text-white">{{ __('Moz') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-moz-access-id-and-secret-key/" target="_blank" class="text-white">{{ __('How to get Moz access id and secret key') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-bordered table-hover settings">
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Access ID') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="moz_access_id">
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Secret Key') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="moz_secret_key">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Moz -->

        <!-- Begin:Google -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="card-title text-white">{{ __('Google API Key') }} (<a href="https://docs.themeluxury.com/sumoseotools/getting-started/how-to-get-google-api-key/" target="_blank" class="text-white">{{ __('How to get Google API Key') }}</a>)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('API Key') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="google_api_key">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Google -->

        <!-- Begin:IndexNow -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h6 class="text-white mb-0">{{ __('IndexNow') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover settings">
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('API Key') }}</label></td>
                                <td class="align-middle">
                                    <input class="form-control" wire:model.defer="indexnow_api_key" disabled>
                                    <small class="form-hint mt-1 d-block">{{ __('The IndexNow API key proves the ownership of the site. It is generated automatically. You can change the key if it becomes known to third parties.') }}</small>
                                    <a class="btn btn-sm bg-gradient-info mt-2" wire:click="onIndexNowAPIKey">
                                        <i class="fas fa-sync-alt me-1"></i>
                                        {{ __('Change Key') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('API Key Location') }}</label></td>
                                <td class="align-middle">
                                    <code>{{ route('home') . '/' . $this->indexnow_api_key . '.txt' }}</code>
                                    <small class="form-hint mt-1 d-block">{{ __('Use the Check Key button to verify that the key is accessible for search engines. Clicking on it should open the key file in your browser and show the API key.') }}</small>
                                    <a class="btn btn-sm bg-gradient-danger mt-2" href="{{ route('home') . '/' . $this->indexnow_api_key . '.txt' }}" target="_blank">
                                        <i class="fas fa-check me-1"></i>
                                        {{ __('Check Key') }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:IndexNow -->
        
        <div class="form-group">
            <button class="btn bg-gradient-primary float-end mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onUpdateAPIKeys">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>

    </form>
    
</div>