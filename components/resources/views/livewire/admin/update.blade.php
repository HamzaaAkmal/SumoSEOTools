<div>

    <form wire:submit.prevent="onUpdateDatabase">

        <!-- Begin:Update -->
        <div class="card">
            <div class="card-body text-center py-4 p-sm-5">

                <img src="{{ asset('assets/img/update.svg') }}" height="128" class="mb-n2">
                <h3 class="mt-5">{{ __('Update') }}</h3>
                <p class="text-muted">{{ __('Click the button below to update the database to the latest version!') }}</p>

				<div class="alert-message">
				  <!-- Session Status -->
				  <x-auth-session-status class="mb-4" :status="session('status')" />
											  
				  <!-- Validation Errors -->
				  <x-auth-validation-errors class="mb-4" :errors="$errors" />
				</div>

				@if (!$updated)
					<div class="form-group mb-0">
						<button class="btn bg-gradient-primary mx-auto d-block mb-0" wire:loading.attr="disabled">
						  <span>
							<div wire:loading.inline wire:target="onUpdateDatabase">
							  <x-loading />
							</div>
							<span>{{ __('Start') }}</span>
						  </span>
						</button>
					</div>
				@endif
            </div>
        </div>
        <!-- End:Update -->

    </form>

    <div class="text-center text-muted mt-3">
        {{ __('Go back to the') }}
        <a href="{{ route('home') }}" tabindex="-1"> {{ __('Homepage') }}</a>
    </div>

</div>
