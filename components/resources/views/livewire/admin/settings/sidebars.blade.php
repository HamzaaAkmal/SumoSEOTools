<div>

    <form wire:submit.prevent="onUpdateSidebars">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <div class="row">
 
            <div class="col-12">

                <div class="card mb-3">
                    <div class="card-header bg-gradient-info">
                        <h6 class="text-white mb-0">{{ __('Popular Tools') }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover table-bordered settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="fw-bold">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="tool_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle w-25"><label class="fw-bold">{{ __('Sticky') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" wire:model="tool_sticky">
                                        </div>
                                    </td>
                                </tr>

                                @if( $tool_status )

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Number of tools you want to display') }}</label></td>
                                        <td class="align-middle">
                                            <input type="text" class="form-control" wire:model.defer="tool_count">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Align') }}</label></td>
                                        <td class="align-middle">
                                            <select class="form-control form-select" wire:model.defer="tool_align">
                                                <option value="start">{{ __('Left') }}</option>
                                                <option value="end">{{ __('Right') }}</option>
                                                <option value="center">{{ __('Center') }}</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Background') }}</label></td>
                                        <td class="align-middle">
                                            <select name="align" class="form-control form-select" wire:model.defer="tool_background">
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
                                        </td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <h6 class="text-white mb-0">{{ __('Recent Posts') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="fw-bold">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" wire:model="post_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle w-25"><label class="fw-bold">{{ __('Sticky') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" wire:model="post_sticky">
                                        </div>
                                    </td>
                                </tr>

                                @if( $post_status )
                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Number of posts you want to display') }}</label></td>
                                        <td class="align-middle">
                                            <input type="text" class="form-control" wire:model.defer="post_count">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Align') }}</label></td>
                                        <td class="align-middle">
                                            <select class="form-control form-select" wire:model.defer="post_align">
                                                <option value="start">{{ __('Left') }}</option>
                                                <option value="end">{{ __('Right') }}</option>
                                                <option value="center">{{ __('Center') }}</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Background') }}</label></td>
                                        <td class="align-middle">
                                            <select name="align" class="form-control form-select" wire:model.defer="post_background">
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
                                        </td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button class="btn bg-gradient-primary float-end mb-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onUpdateSidebars">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>
            </div>

        </div>

    </form>

</div>