<div>
    
    <form wire:submit.prevent="onEditUser({{ $this->user_id }})">
        <div class="modal-body">
            
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>

            <div class="form-group">
                <label for="fullname" class="form-label">Full name</label>
                <div class="input-group">
                    <input class="form-control @error('fullname') is-invalid @enderror" type="text" wire:model.defer="fullname" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model.defer="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" wire:model.defer="password">
                </div>
                <span class="form-hint text-sm">{{ __('Just leave it blank in case you don\'t want to change the new password.') }}</span>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onEditUser">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
