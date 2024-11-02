<div>

	<form wire:submit.prevent="onUpdateNotice">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<!-- Begin:GDPR Privacy Notice -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">

					<div class="form-group">
						
						<div class="d-flex">
							<label for="ads-area-1" class="form-label">{{ __('GDPR Privacy Notice') }}</label>
							<div class="form-check form-switch ps-3 align-items-start">
								<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="status">
							</div>
						</div>

						<div class="col">
							<textarea class="form-control" rows="8" wire:model.defer="notice"></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="input-group">

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
									<select name="align" class="form-control ps-3 form-select" wire:model.defer="align">
										<option value="text-start">{{ __('Left') }}</option>
										<option value="text-end">{{ __('Right') }}</option>
										<option value="text-center">{{ __('Center') }}</option>
									</select>
								</div>
							</div>

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Background Color') }}</button>
		                            <select name="align" class="form-control ps-3 form-select" wire:model.defer="background">
                                        <optgroup label="{{ __('Base colors') }}">
                                            <option value="bg-white">{{ __('White') }}</option>
                                            <option value="bg-default">{{ __('Default') }}</option>
                                            <option value="bg-primary">{{ __('Primary') }}</option>
                                            <option value="bg-secondary">{{ __('Secondary') }}</option>
                                            <option value="bg-success">{{ __('Success') }}</option>
                                            <option value="bg-info">{{ __('Info') }}</option>
                                            <option value="bg-warning">{{ __('Warning') }}</option>
                                            <option value="bg-danger">{{ __('Danger') }}</option>
                                        </optgroup>
                                        <optgroup label="{{ __('Gradient colors') }}">
                                            <option value="bg-gradient-primary">{{ __('Primary') }}</option>
                                            <option value="bg-gradient-secondary">{{ __('Secondary') }}</option>
                                            <option value="bg-gradient-success">{{ __('Success') }}</option>
                                            <option value="bg-gradient-info">{{ __('Info') }}</option>
                                            <option value="bg-gradient-warning">{{ __('Warning') }}</option>
                                            <option value="bg-gradient-danger">{{ __('Danger') }}</option>
                                        </optgroup>
		                            </select>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Enable Button') }}</button>
									<select class="form-control ps-3 form-select" wire:model.defer="button">
										<option value="1">{{ __('Yes') }}</option>
										<option value="0">{{ __('No') }}</option>
									</select>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End:GDPR Privacy Notice -->

		<div class="form-group mt-3">
			<button class="btn bg-gradient-primary float-end mb-0" wire:loading.attr="disabled">
				<span>
					<div wire:loading.inline wire:target="onUpdateNotice">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>