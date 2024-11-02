<div>

      <form wire:submit.prevent="onTextCompare">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('Text one') }}</label>
            <div class="position-relative">
                <textarea id="inputOne" class="form-control" wire:model.defer="text_one" rows="10" placeholder="{{ __('Enter or Paste your original text here...') }}" required></textarea>
                
                <div id="pasteOne" class="btn btn-icon-only cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                  <i class="far fa-clipboard"></i>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('Text two') }}</label>
            <div class="position-relative">
                <textarea id="inputTwo" class="form-control" wire:model.defer="text_two" rows="10" placeholder="{{ __('Enter or Paste the text you want to compare here...') }}" required></textarea>
                
                <div id="pasteTwo" class="btn btn-icon-only cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                  <i class="far fa-clipboard"></i>
                </div>
            </div>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif

        <div class="form-group text-center mb-0">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onTextCompare">
                  <x-loading />
                </div>
                <span wire:target="onTextCompare">{{ __('Compare') }}</span>
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
          <div class="card position-relative mt-3 result">
            <div class="card-body">
                {!! $data !!}
            </div>
          </div>
        @endif
        
      </form>

      <script>
        (function( $ ) {
          "use strict";

              document.addEventListener('livewire:load', function () {

                //One
                var elOne      = document.getElementById('pasteOne');
                var inputOne   = document.getElementById('inputOne');
                var tooltipOne = new bootstrap.Tooltip(elOne);

                var pasteIconOne = '<i class="far fa-clipboard"></i>';
                var clearIconOne = '<i class="fas fa-trash"></i>';

                function setPasteIconOne() {
                  elOne.innerHTML = pasteIconOne;
                  tooltipOne.dispose();
                  elOne.setAttribute('title', '{{ __('Paste') }}');
                  elOne.classList.add('bg-gradient-secondary');
                  elOne.classList.remove('btn-danger');
                  tooltipOne = new bootstrap.Tooltip(elOne);
                }

                function setClearIconOne() {
                  elOne.innerHTML = clearIconOne;
                  tooltipOne.dispose();
                  elOne.setAttribute('title', '{{ __('Clear') }}');
                  elOne.classList.add('btn-danger');
                  elOne.classList.remove('bg-gradient-secondary');
                  tooltipOne = new bootstrap.Tooltip(elOne);
                }

                function checkInputValueOne() {
                  if (inputOne.value) {
                    setClearIconOne();
                  } else {
                    setPasteIconOne();
                  }
                }

                checkInputValueOne(); // Initial check in case there's a value already

                // Handle click on the icon
                elOne.addEventListener('click', function() {
                  if (elOne.innerHTML === clearIconOne) {
                    // Clear action
                    @this.set('text_one', ''); // Update Livewire state
                    setPasteIconOne();
                  } else {
                    // Paste action
                    navigator.clipboard.readText().then(function(clipText) {
                      @this.set('text_one', clipText);
                      setClearIconOne();
                    }).catch(function() {
                      // Handle error if needed
                    });
                  }
                });

                // Handle changes to the input field
                inputOne.addEventListener('input', checkInputValueOne);

                //Two
                var elTwo      = document.getElementById('pasteTwo');
                var inputTwo   = document.getElementById('inputTwo');
                var tooltipTwo = new bootstrap.Tooltip(elTwo);

                var pasteIconTwo = '<i class="far fa-clipboard"></i>';
                var clearIconTwo = '<i class="fas fa-trash"></i>';

                function setPasteIconTwo() {
                  elTwo.innerHTML = pasteIconTwo;
                  tooltipTwo.dispose();
                  elTwo.setAttribute('title', '{{ __('Paste') }}');
                  elTwo.classList.add('bg-gradient-secondary');
                  elTwo.classList.remove('btn-danger');
                  tooltipTwo = new bootstrap.Tooltip(elTwo);
                }

                function setClearIconTwo() {
                  elTwo.innerHTML = clearIconTwo;
                  tooltipTwo.dispose();
                  elTwo.setAttribute('title', '{{ __('Clear') }}');
                  elTwo.classList.add('btn-danger');
                  elTwo.classList.remove('bg-gradient-secondary');
                  tooltipTwo = new bootstrap.Tooltip(elTwo);
                }

                function checkInputValueTwo() {
                  if (inputTwo.value) {
                    setClearIconTwo();
                  } else {
                    setPasteIconTwo();
                  }
                }

                checkInputValueTwo(); // Initial check in case there's a value already

                // Handle click on the icon
                elTwo.addEventListener('click', function() {
                  if (elTwo.innerHTML === clearIconTwo) {
                    // Clear action
                    @this.set('text_two', ''); // Update Livewire state
                    setPasteIconTwo();
                  } else {
                    // Paste action
                    navigator.clipboard.readText().then(function(clipText) {
                      @this.set('text_two', clipText);
                      setClearIconTwo();
                    }).catch(function() {
                      // Handle error if needed
                    });
                  }
                });

                // Handle changes to the input field
                inputTwo.addEventListener('input', checkInputValueTwo);

              });

        })( jQuery );
      </script>
</div>