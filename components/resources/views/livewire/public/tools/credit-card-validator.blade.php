<div>

      <form wire:submit.prevent="onCreditCardValidator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="row">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Credit Card Number') }}</label>
                <div class="col">
                    <div class="input-group input-group-flat">
                        <input type="text" id="input" class="form-control" wire:model.defer="code" placeholder="Add credit card number here" required />
                        <span class="input-group-text">
                            <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                              <i class="far fa-clipboard fa-fw"></i>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Credit Card Type') }}</label>
                <select wire:model.defer="type" class="form-control form-select">
                    <option value="amex">{{ __('American Express') }}</option>
                    <option value="diners">{{ __('Diners Club') }}</option>
                    <option value="discover">{{ __('Discover') }}</option>
                    <option value="jcb">{{ __('JCB') }}</option>
                    <option value="mastercard">{{ __('MasterCard') }}</option>
                    <option value="visa">{{ __('Visa') }}</option>
                </select>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
        
            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onCreditCardValidator">
                            <x-loading />
                        </div>
                        <span wire:target="onCreditCardValidator">{{ __('Check') }}</span>
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

      <div class="form-group mt-3 mb-0">
          <label class="form-label">{{ __('Example credit card numbers') }}</label>
          <div class="table-responsive">
              <table class="table table-striped table-hover table-bordered mb-0">
                <thead class="bg-gradient-secondary text-white">
                    <tr>
                        <th>{{ __('Credit Card Type') }}</th>
                        <th>{{ __('Credit Card Number') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">{{ __('American Express') }}</td>
                        <td>{{ __('371449635398431') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('Diners Club') }}</td>
                        <td>{{ __('30569309025904') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('Discover') }}</td>
                        <td>{{ __('6011111111111117') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('JCB') }}</td>
                        <td>{{ __('3530111333300000') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('MasterCard') }}</td>
                        <td>{{ __('5555555555554444') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('Visa') }}</td>
                        <td>{{ __('4916592289993918') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>

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
                      @this.set('code', ''); // Update Livewire state
                      setPasteIcon();
                    } else {
                      // Paste action
                      navigator.clipboard.readText().then(function(clipText) {
                        @this.set('code', clipText);
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