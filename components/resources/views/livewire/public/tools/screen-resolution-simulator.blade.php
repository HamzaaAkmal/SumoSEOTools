<div>

      <form wire:submit.prevent="onScreenResolutionSimulator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="row">
            <label class="form-label">{{ __('Enter a website URL') }}</label>
            <div class="col">
                <div class="input-group input-group-flat">
                    <input type="text" id="input" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                    <span class="input-group-text">
                        <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                          <i class="far fa-clipboard fa-fw"></i>
                        </div>
                    </span>
                </div>

                <div class="form-group mt-3">
                    <label class="form-label">{{ __('Select Screen Resolution:') }}</label>

                    <select class="form-control form-select" wire:model.defer="resolution">
                        <option value="160x160">{{ __('160x160') }} {{ __('Pixels') }}</option>
                        <option value="320x320">{{ __('320x320') }} {{ __('Pixels') }}</option>
                        <option value="640x480">{{ __('640x480') }} {{ __('Pixels') }}</option>
                        <option value="800x600">{{ __('800x600') }} {{ __('Pixels') }}</option>
                        <option value="1024x768">{{ __('1024x768') }} {{ __('Pixels') }}</option>
                        <option value="1152x864">{{ __('1152x864') }} {{ __('Pixels') }}</option>
                        <option value="1280x720">{{ __('1280x720') }} {{ __('Pixels') }}</option>
                        <option value="1366x768">{{ __('1366x768') }} {{ __('Pixels') }}</option>
                        <option value="1600x1200">{{ __('1600x1200') }} {{ __('Pixels') }}</option>
                        <option value="1920x1080">{{ __('1920x1080') }} {{ __('Pixels') }}</option>
                        <option value="custom">{{ __('Custom') }}</option>
                    </select>
                </div>
                
                @if ( $resolution == 'custom')
                    <div class="form-group my-3">
                        <label class="form-label">{{ __('Enter Custom Resolution:') }}</label>
                        <input type="text" class="form-control" wire:model.defer="custom_resolution" placeholder="900x900" />
                    </div>
                @endif

            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
            
            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onScreenResolutionSimulator">
                            <x-loading />
                        </div>
                        <span wire:target="onScreenResolutionSimulator">{{ __('Simulate') }}</span>
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
        </div>

      </form>

        <script>
           (function( $ ) {
              "use strict";

                document.addEventListener('livewire:load', function () {

                      var el      = document.getElementById('paste');
                      var input   = document.getElementById('input');
                      var tooltip = new bootstrap.Tooltip(el);

                      var pasteIcon = '<i class="far fa-clipboard fa-fw"></i>';
                      var clearIcon = '<i class="fas fa-trash fa-fw"></i>';

                      function setPasteIcon() {
                        el.innerHTML = pasteIcon;
                        tooltip.dispose();
                        el.setAttribute('title', '{{ __('Paste') }}');
                        el.classList.remove('text-danger');
                        tooltip = new bootstrap.Tooltip(el);
                      }

                      function setClearIcon() {
                        el.innerHTML = clearIcon;
                        tooltip.dispose();
                        el.setAttribute('title', '{{ __('Clear') }}');
                        el.classList.add('text-danger');
                        tooltip = new bootstrap.Tooltip(el);
                      }

                      function checkInputValue() {
                        if (input.value) {
                          setClearIcon();
                        } else {
                          setPasteIcon();
                        }
                      }

                      checkInputValue(); // Initial check in case there's a value already

                      // Handle click on the icon
                      el.addEventListener('click', function() {
                        if (el.innerHTML === clearIcon) {
                          // Clear action
                          @this.set('link', ''); // Update Livewire state
                          setPasteIcon();
                        } else {
                          // Paste action
                          navigator.clipboard.readText().then(function(clipText) {
                            @this.set('link', clipText);
                            setClearIcon();
                          }).catch(function() {
                            // Handle error if needed
                          });
                        }
                      });

                      // Handle changes to the input field
                      input.addEventListener('input', checkInputValue);

                    window.addEventListener('onSetScreenResolution', event => {
                        window.open(event.detail.link, event.detail.resolution,'toolbar=yes,location=yes,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=no,copyhistory=yes,width='+event.detail.width+',height='+event.detail.height);  
                    });
                });

          })( jQuery );
        </script>
</div>