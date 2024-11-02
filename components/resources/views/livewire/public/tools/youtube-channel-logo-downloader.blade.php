<div>

      <form wire:submit.prevent="onYoutubeChannelLogoDownloader">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Enter YouTube Channel URL') }}</label>
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
                        <div wire:loading.inline wire:target="onYoutubeChannelLogoDownloader">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeChannelLogoDownloader">{{ __('Download') }}</span>
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
                    <div class="card border rounded mt-3">
                      <ul class="nav nav-tabs nav-pills rounded" data-bs-toggle="tabs">
                        @foreach ($data as $element)
                            <li class="nav-item">
                              <a href="#tabs-{{ $loop->index }}" class="rounded nav-link {{ ($loop->index == 0) ? 'active' : '' }}" data-bs-toggle="tab">{{ $element['resolution'] }}</a>
                            </li>
                        @endforeach

                      </ul>
                      <div class="card-body rounded">
                        <div class="tab-content text-center">
                            @foreach ($data as $element)
                                <div class="tab-pane {{ ($loop->index == 0) ? 'active show' : '' }}" id="tabs-{{ $loop->index }}">
                                    <div class="form-group text-cente  mx-auto mb-3">
                                        <a class="btn bg-gradient-success download-image mb-0" href="{{ $element['download'] }}" download>
                                            <i class="fas fa-download text-white me-1"></i>
                                            {{ __('Download Image') }}
                                        </a>
                                    </div>
                                  <img src="{{ $element['preview'] }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                      </div>
                    </div>
              @endif

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

              });

        })( jQuery );
      </script>
</div>