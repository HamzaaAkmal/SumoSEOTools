<div>

      <form wire:submit.prevent="onJsonToJsonSchema">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
        <div class="form-group position-relative">
            <textarea id="input" class="form-control" wire:model.defer="json" rows="10" placeholder="{{ __('Enter or Paste your content here...') }}" required></textarea>
            
            <div id="paste" class="btn btn-icon-only cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
              <i class="far fa-clipboard"></i>
            </div>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif

        <div class="form-group text-center mb-0">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onJsonToJsonSchema">
                  <x-loading />
                </div>
                <span wire:target="onJsonToJsonSchema">{{ __('Convert') }}</span>
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
          <div class="form-group position-relative mt-3">
              <textarea id="text" class="form-control" rows="10">{!! $data !!}</textarea>
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

            var pasteIcon = '<i class="far fa-clipboard"></i>';
            var clearIcon = '<i class="fas fa-trash"></i>';

            function setPasteIcon() {
              el.innerHTML = pasteIcon;
              tooltip.dispose();
              el.setAttribute('title', '{{ __('Paste') }}');
              el.classList.add('bg-gradient-secondary');
              el.classList.remove('btn-danger');
              tooltip = new bootstrap.Tooltip(el);
            }

            function setClearIcon() {
              el.innerHTML = clearIcon;
              tooltip.dispose();
              el.setAttribute('title', '{{ __('Clear') }}');
              el.classList.add('btn-danger');
              el.classList.remove('bg-gradient-secondary');
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
                @this.set('article', ''); // Update Livewire state
                setPasteIcon();
              } else {
                // Paste action
                navigator.clipboard.readText().then(function(clipText) {
                  @this.set('article', clipText);
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