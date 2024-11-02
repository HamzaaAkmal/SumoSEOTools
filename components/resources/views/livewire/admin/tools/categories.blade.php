<div>   
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">

                    <form wire:submit.prevent="addNewCategory">
					
						<div class="alert-message">
						  <!-- Session Status -->
						  <x-auth-session-status class="mb-4" :status="session('status')" />
													  
						  <!-- Validation Errors -->
						  <x-auth-validation-errors class="mb-4" :errors="$errors" />
						</div>
			
                        <div class="form-group">
                            <label class="form-label">{{ __('Title') }}</label>
                            <input class="form-control" type="text" wire:model.defer="title">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Description') }}</label>
                            <input class="form-control" type="text" wire:model.defer="description">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Text Align') }}</label>
                            <select name="align" class="form-control form-select" wire:model.defer="align">
                                <option value="start">{{ __('Left') }}</option>
                                <option value="end">{{ __('Right') }}</option>
                                <option value="center">{{ __('Center') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Background') }}</label>
                            <select name="align" class="form-control form-select" wire:model.defer="background">
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

                        <div class="form-group">
                            <button class="btn bg-gradient-info float-end mb-0" wire:loading.attr="disabled">
                                <span>
                                    <div wire:loading.inline wire:target="addNewCategory">
                                        <x-loading />
                                    </div>
                                    <span>{{ __('Add New Category') }}</span>
                                </span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="nestable" class="dd mw-100">

                        @php
                            function get_categories($categories, $class = 'dd-list') {

                                $html = '<ol class="'.$class.'">';

                                foreach($categories as $key => $value) {
                                    $html .= '<li class="dd-item" data-id="'.$value['id'].'">
                                                    <div class="float-end btn-handle">
                                                        <button class="badge bg-primary border-0" wire:click.prevent="editCategory('.$value['id'].')">'.__('Edit').'</button>
                                                        <button class="badge bg-danger border-0" wire:click.prevent="removeCategory('.$value['id'].')">'.__('Delete').'</button>
                                                    </div>

                                                    <div class="dd-handle">
                                                        <h6>'.$value['title'].'</h6>
                                                        <span class="fw-normal">'.$value['description'].'</span>
                                                    </div>';

                                    $html .'</li>';
                                }

                                $html .= '</ol>';

                                return $html;
                            }

                            echo get_categories($categories);

                        @endphp
                    </div>

                    <div class="col-auto">
                        <button class="btn bg-gradient-primary float-end mt-3 mb-0" id="onUpdateCategory" wire:loading.attr="disabled">
                          <span>
                            <div wire:loading wire.emit.target="onUpdateCategory">
                              <x-loading />
                            </div>
                            <span>{{ __('Save Changes') }}</span>
                          </span>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Nestable -->
    <script src="{{ asset('assets/js/jquery.nestable.min.js') }}"></script>
    <link type="text/css" href="{{ asset('assets/css/jquery.nestable.min.css') }}" rel="stylesheet">
        
    <style>
        .dd .btn-handle {
            transform: translate(-10%, 50%);
        }

        .btn-handle button{
            cursor: pointer;
        }

        .dd .dd-handle .url {
            font-weight: 400;
            margin-left: 10px;
        }

        .dd-handle{
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            height: 100%;
            padding: 14px 25px;
            cursor: move;
        }

        .dd-item>button.dd-collapse:before {
            content: '';
        }
    </style>
    <script>
    (function( $ ) {
        "use strict";

        jQuery(document).ready(function(){

            jQuery('#nestable').nestable({ serialize: true, maxDepth: 1 });

            jQuery('#onUpdateCategory').click(function(e){
                e.preventDefault();
                var data = jQuery('#nestable').nestable('serialize');
                window.livewire.emit('onUpdateCategory', data)

            });

        });

    })( jQuery );
    </script>

</div>