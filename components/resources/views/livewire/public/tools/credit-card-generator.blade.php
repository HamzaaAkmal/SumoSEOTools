<div>

      <form wire:submit.prevent="onCreditCardGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Select card') }}</label>
            <div class="col">
                <select wire:model.defer="type" class="form-control form-select">
                    <option value="amex">{{ __('American Express') }}</option>
                    <option value="diners">{{ __('Diners Club') }}</option>
                    <option value="discover">{{ __('Discover') }}</option>
                    <option value="jcb">{{ __('JCB') }}</option>
                    <option value="mastercard">{{ __('MasterCard') }}</option>
                    <option value="visa">{{ __('Visa') }}</option>
                </select>
            </div>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif
         
        <div class="form-group mb-0 text-center">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onCreditCardGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onCreditCardGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>    

        @if ( !empty($data) )
            <div class="form-group mt-3 mb-0">
                <label class="form-label">{{ __('Credit Card Number') }}</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="text" id="text" class="form-control" value="{{ $data['code'] }}">
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-icon-only btn-success" value="copy" onclick="copyToClipboard()" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                            <i class="fas fa-copy"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif

      </form>

      <script>
          function copyToClipboard() {
            document.getElementById("text").select();
            document.execCommand('copy');
          }
      </script>
</div>