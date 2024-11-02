<div>

      <form wire:submit.prevent="onYoutubeTagExtractor">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
    
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Enter YouTube Video URL') }}</label>
                <div class="col">
                    <div class="input-group input-group-flat">
                        <input type="text" id="input" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                        <span class="input-group-text">
                            <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                              <i class="far fa-clipboard fa-fw"></i>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif

            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onYoutubeTagExtractor">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeTagExtractor">{{ __('Extract') }}</span>
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

        @if ( !empty($temp_data) )
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                <div class="form-group mb-0 text-center">
                    <label class="form-label text-white">{{ __('Click on a word you like if you want to temporarily store it in the box below.') }}</label>
                    <div class="form-selectgroup">
                        @foreach ($temp_data[0] as $value)
                            <label class="form-selectgroup-item" wire:click.prevent="onSetInList('{{ $value }}')">
                                <input type="checkbox" name="name" value="{{ $value }}" class="form-selectgroup-input" />
                                <span class="form-selectgroup-label">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </fieldset>
        @endif

        @if ( !empty($data) )
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                <div class="form-group">
                  <label class="form-label text-white">{{ __('Your word list') }}</label>
                  <textarea id="text" class="form-control" rows="6">@php

                        $count = 0;

                        $countData = count($data);

                        foreach ($data as $value) {
                            
                            $count++;

                            if ($count < $countData) 
                            {
                                $value .= ", ";
                            }

                            echo $value;
                        }

                    @endphp</textarea>
                </div>

                <div class="form-group text-center mb-0">
                    <a class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" value="copy" onclick="copyToClipboard()">{{ __('Copy selected words') }}</a>
                    <a class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onClearInList">{{ __('Clear selected words') }}</a>
                </div>
            </fieldset>
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

              });

        })( jQuery );
      </script>
</div>