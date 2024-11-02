<div>

      <form wire:submit.prevent="onHtaccessRedirectGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Enter a domain name') }}</label>
            <div class="col">
                <div class="input-group input-group-flat">
                    <input type="text" id="input" class="form-control" wire:model.defer="domain" placeholder="example.com" required />
                    <span class="input-group-text">
                        <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                          <i class="far fa-clipboard fa-fw"></i>
                        </div>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="input-group">
                <p class="d-block w-100 form-label">{{ __('Select redirect type:') }}</p>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="type" id="nonwww" value="nonwww" wire:model.defer="type">
                  <label class="form-check-label" for="nonwww">{{ __('Redirect from www to non-www') }}</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="type" id="www" value="www" wire:model.defer="type">
                  <label class="form-check-label" for="www">{{ __('Redirect from non-www to www') }}</label>
                </div>
            </div>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif

         <div class="form-group mb-0 text-center">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onHtaccessRedirectGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onHtaccessRedirectGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

          @if ( !empty($data) )
            <div class="form-group position-relative mt-3">
                <textarea id="text" class="form-control" rows="10">{{ $data['code'] }}</textarea>
                <a value="copy" onclick="copyToClipboard()" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                    <i class="fas fa-copy"></i>
                </a>
            </div>
          @endif

      </form>

      <script>
          function copyToClipboard() {
            document.getElementById("text").select();
            document.execCommand('copy');
          }
      </script>
      
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
                  @this.set('domain', ''); // Update Livewire state
                  setPasteIcon();
                } else {
                  // Paste action
                  navigator.clipboard.readText().then(function(clipText) {
                    @this.set('domain', clipText);
                    setClearIcon();
                  }).catch(function() {
                    // Handle error if needed
                  });
                }
              });

              // Handle changes to the input field
              input.addEventListener('input', checkInputValue);

          });

        })( jQuery );
      </script>
</div>