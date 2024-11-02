<div class="card h-100 tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab" wire:ignore.self>
	<div class="card-header bg-gradient-secondary">
		<span class="card-title text-white text-bold">{{ __('Change Password') }}</span>
	</div>
	<div class="card-body">

		<form wire:submit.prevent="onChangePassword">

			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>
			
			<div class="form-group">
				<label for="current_password" class="form-label">{{ __('Current Password') }}</label>
				<input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" wire:model.defer="current_password" required>
			</div>

			<div class="form-group">
				<label for="new_password" class="form-label">{{ __('New Password') }}</label>
				<input class="form-control @error('new_password') is-invalid @enderror" type="password" id="new_password" wire:model.defer="new_password" required>
			</div>

			<div class="form-group">
				<label for="retype_new_password" class="form-label">{{ __('Retype New Password') }}</label>
				<input class="form-control @error('retype_new_password') is-invalid @enderror" type="password" id="retype_new_password" wire:model.defer="retype_new_password" required>
			</div>

			<div class="form-group mb-0 text-end">
				<button class="btn bg-gradient-primary mb-0" wire:loading.attr="disabled">
					<span>
						<div wire:loading.inline wire:target="onChangePassword">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

		</form>

	</div>
</div>
					          
