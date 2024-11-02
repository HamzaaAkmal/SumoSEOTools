<div>

      <form wire:submit.prevent="onYoutubeTagGenerator">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
    
            <div class="row">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label class="form-label col-form-label">{{ __('Enter your keyword') }}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group input-group-flat">
                                <input type="text" id="input" class="form-control" wire:model.defer="query" placeholder="seo" required />
                                <span class="input-group-text">
                                    <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                                      <i class="far fa-clipboard fa-fw"></i>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label class="form-label col-form-label">{{ __('Language') }}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control form-select" wire:model.defer="lang" required>
                              <option value="AF">{{ __('Afrikaans') }}</option>
                              <option value="SQ">{{ __('Albanian') }}</option>
                              <option value="AR">{{ __('Arabic') }}</option>
                              <option value="HY">{{ __('Armenian') }}</option>
                              <option value="EU">{{ __('Basque') }}</option>
                              <option value="BN">{{ __('Bengali') }}</option>
                              <option value="BG">{{ __('Bulgarian') }}</option>
                              <option value="CA">{{ __('Catalan') }}</option>
                              <option value="KM">{{ __('Cambodian') }}</option>
                              <option value="ZH">{{ __('Chinese (Mandarin)') }}</option>
                              <option value="HR">{{ __('Croatian') }}</option>
                              <option value="CS">{{ __('Czech') }}</option>
                              <option value="DA">{{ __('Danish') }}</option>
                              <option value="NL">{{ __('Dutch') }}</option>
                              <option value="EN">{{ __('English') }}</option>
                              <option value="ET">{{ __('Estonian') }}</option>
                              <option value="FJ">{{ __('Fiji') }}</option>
                              <option value="FI">{{ __('Finnish') }}</option>
                              <option value="FR">{{ __('French') }}</option>
                              <option value="KA">{{ __('Georgian') }}</option>
                              <option value="DE">{{ __('German') }}</option>
                              <option value="EL">{{ __('Greek') }}</option>
                              <option value="GU">{{ __('Gujarati') }}</option>
                              <option value="HE">{{ __('Hebrew') }}</option>
                              <option value="HI">{{ __('Hindi') }}</option>
                              <option value="HU">{{ __('Hungarian') }}</option>
                              <option value="IS">{{ __('Icelandic') }}</option>
                              <option value="ID">{{ __('Indonesian') }}</option>
                              <option value="GA">{{ __('Irish') }}</option>
                              <option value="IT">{{ __('Italian') }}</option>
                              <option value="JA">{{ __('Japanese') }}</option>
                              <option value="JW">{{ __('Javanese') }}</option>
                              <option value="KO">{{ __('Korean') }}</option>
                              <option value="LA">{{ __('Latin') }}</option>
                              <option value="LV">{{ __('Latvian') }}</option>
                              <option value="LT">{{ __('Lithuanian') }}</option>
                              <option value="MK">{{ __('Macedonian') }}</option>
                              <option value="MS">{{ __('Malay') }}</option>
                              <option value="ML">{{ __('Malayalam') }}</option>
                              <option value="MT">{{ __('Maltese') }}</option>
                              <option value="MI">{{ __('Maori') }}</option>
                              <option value="MR">{{ __('Marathi') }}</option>
                              <option value="MN">{{ __('Mongolian') }}</option>
                              <option value="NE">{{ __('Nepali') }}</option>
                              <option value="NO">{{ __('Norwegian') }}</option>
                              <option value="FA">{{ __('Persian') }}</option>
                              <option value="PL">{{ __('Polish') }}</option>
                              <option value="PT">{{ __('Portuguese') }}</option>
                              <option value="PA">{{ __('Punjabi') }}</option>
                              <option value="QU">{{ __('Quechua') }}</option>
                              <option value="RO">{{ __('Romanian') }}</option>
                              <option value="RU">{{ __('Russian') }}</option>
                              <option value="SM">{{ __('Samoan') }}</option>
                              <option value="SR">{{ __('Serbian') }}</option>
                              <option value="SK">{{ __('Slovak') }}</option>
                              <option value="SL">{{ __('Slovenian') }}</option>
                              <option value="ES">{{ __('Spanish') }}</option>
                              <option value="SW">{{ __('Swahili') }}</option>
                              <option value="SV">{{ __('Swedish ') }}</option>
                              <option value="TA">{{ __('Tamil') }}</option>
                              <option value="TT">{{ __('Tatar') }}</option>
                              <option value="TE">{{ __('Telugu') }}</option>
                              <option value="TH">{{ __('Thai') }}</option>
                              <option value="BO">{{ __('Tibetan') }}</option>
                              <option value="TO">{{ __('Tonga') }}</option>
                              <option value="TR">{{ __('Turkish') }}</option>
                              <option value="UK">{{ __('Ukrainian') }}</option>
                              <option value="UR">{{ __('Urdu') }}</option>
                              <option value="UZ">{{ __('Uzbek') }}</option>
                              <option value="VI">{{ __('Vietnamese') }}</option>
                              <option value="CY">{{ __('Welsh') }}</option>
                              <option value="XH">{{ __('Xhosa') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
                  <x-public.recaptcha />
                @endif
            
                <div class="form-group text-center mb-0">
                    <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onYoutubeTagGenerator">
                                <x-loading />
                            </div>
                            <span wire:target="onYoutubeTagGenerator">{{ __('Generate') }}</span>
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

            @if ( !empty($temp_data) )
                <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                    <div class="form-group mb-0 text-center">
                        <label class="form-label text-white">{{ __('Click on a tag you like if you want to temporarily store it in the box below.') }}</label>
                        <div class="form-selectgroup">
                            @foreach ($temp_data as $value)
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
                      <label class="form-label text-white">{{ __('Your tag list') }}</label>
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
                        <a class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" value="copy" onclick="copyToClipboard()">{{ __('Copy selected tags') }}</a>
                        <a class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onClearInList">{{ __('Clear selected tags') }}</a>
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
                      @this.set('query', ''); // Update Livewire state
                      setPasteIcon();
                    } else {
                      // Paste action
                      navigator.clipboard.readText().then(function(clipText) {
                        @this.set('query', clipText);
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