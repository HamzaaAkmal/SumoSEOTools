<div>

      <form wire:submit.prevent="onAdsenseCalculator">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-md-3">
						<label class="form-label col-form-label">{{ __('Page Impressions') }}</label>
					</div>
					<div class="col-12 col-md-9">
					  <input type="text" wire:model.defer="impressions" class="form-control" required>
					</div>
				</div>
			</div>

            <div class="form-group">
                <div class="row">
                  <div class="col-12 col-md-3">
                    <label class="form-label col-form-label">{{ __('Click Through Rate (CTR) in %') }}</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" wire:model.defer="ctr" class="form-control" required>
                  </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                  <div class="col-12 col-md-3">
                    <label class="form-label col-form-label">{{ __('Cost Per Click') }}</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" wire:model.defer="cpc" class="form-control" required>
                  </div>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
        
            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onAdsenseCalculator">
                            <x-loading />
                        </div>
                        <span wire:target="onAdsenseCalculator">{{ __('Calculate') }}</span>
                    </span>
                </button>

                <button class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" wire:click.prevent="onSample" wire:loading.attr="disabled">
                    <span>
                      <div wire:loading.inline wire:target="onSample">
                        <x-loading />
                      </div>
                        <span wire:target="onSample">{{ __('Sample') }}</span>
                    </span>
                </button>

                <button class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onReset" wire:loading.attr="disabled">
                    <span>
                      <div wire:loading.inline wire:target="onReset">
                        <x-loading />
                      </div>
                        <span wire:target="onReset">{{ __('Reset') }}</span>
                    </span>
                </button>
            </div>
            
            @if ( !empty($data) )
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="bg-gradient-success text-white">
                            <tr>
                                <th>{{ __('Periods') }}</th>
                                <th>{{ __('Earnings') }}</th>
                                <th>{{ __('Clicks') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('Daily') }}</td>
                                <td>${{ $data['daily_earnings'] }}</td>
                                <td>{{ $data['daily_clicks'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Monthly') }}</td>
                                <td>${{ $data['mothly_earnings'] }}</td>
                                <td>{{ $data['mothly_clicks'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Yearly') }}</td>
                                <td>${{ $data['yearly_earnings'] }}</td>
                                <td>{{ $data['yearly_clicks'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

      </form>
</div>