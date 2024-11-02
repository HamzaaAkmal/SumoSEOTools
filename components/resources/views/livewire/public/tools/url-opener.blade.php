<div>

      <form wire:submit.prevent="onUrlOpener">
        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
        <div class="form-group mb-3">
            <label class="form-label">{{ __('Enter each url must be in separate line:') }}</label>
            <textarea class="form-control" wire:model.defer="links" rows="10" placeholder="{{ __('Enter or Paste your URLs here...') }}" required></textarea>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center mb-0">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onUrlOpener">
                  <x-loading />
                </div>
                <span wire:target="onUrlOpener">{{ __('Open') }}</span>
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
      </form>

        <script>
           (function( $ ) {
              "use strict";

                document.addEventListener('livewire:load', function () {

                    window.addEventListener('onSetUrlOpener', event => {

                        var link = event.detail.links;
                        $(link).each(function(){
                            window.open(this, '_blank');
                        });

                    });

                });

          })( jQuery );
        </script>
</div>