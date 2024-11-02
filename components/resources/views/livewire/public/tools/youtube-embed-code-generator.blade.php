<div>

      <form wire:submit.prevent="onYoutubeEmbedCodeGenerator">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
        
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Enter YouTube Video URL') }}</label>

                <div class="input-group input-group-flat">
                    <input type="text" id="input" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                    <span class="input-group-text">
                        <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                          <i class="far fa-clipboard fa-fw"></i>
                        </div>
                    </span>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Size') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify. Default: 560x315') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="size_width" placeholder="{{ __('Width') }}">
                    <div class="input-group-prepend bg-gradient-secondary">
                        <span class="input-group-text bg-gradient-secondary border-0 text-white">{{ __('x') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="size_height" placeholder="{{ __('Height') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Start time') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="start_min" placeholder="{{ __('Minute(s)') }}">
                    <div class="input-group-prepend bg-gradient-secondary">
                        <span class="input-group-text bg-gradient-secondary border-0 text-white">{{ __(':') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="start_sec" placeholder="{{ __('Second(s)') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('End time') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="end_min" placeholder="{{ __('Minute(s)') }}">
                    <div class="input-group-prepend bg-gradient-secondary">
                        <span class="input-group-text bg-gradient-secondary border-0 text-white">{{ __(':') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="end_sec" placeholder="{{ __('Second(s)') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="card">
                    <div class="card-header bg-gradient-success text-white fw-bold p-3">
                        {{ __('Options') }}
                    </div>

                    <div class="card-body">
                        <div class="form-check">
                          <input id="loop_video" class="form-check-input" type="checkbox" wire:model.defer="loop_video">
                          <label for="loop_video" class="cursor-pointer">{{ __('Loop video') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="auto_play_video" class="form-check-input" type="checkbox" wire:model.defer="auto_play_video">
                          <label for="auto_play_video" class="cursor-pointer">{{ __('Auto play video') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_full_screen_button" class="form-check-input" type="checkbox" wire:model.defer="hide_full_screen_button">
                          <label for="hide_full_screen_button" class="cursor-pointer">{{ __('Hide Full-screen button') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_player_controls" class="form-check-input" type="checkbox" wire:model.defer="hide_player_controls">
                          <label for="hide_player_controls" class="cursor-pointer">{{ __('Hide player controls') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_youtube_logo" class="form-check-input" type="checkbox" wire:model.defer="hide_youtube_logo">
                          <label for="hide_youtube_logo" class="cursor-pointer">{{ __('Hide YouTube logo') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="no_cookie" class="form-check-input" type="checkbox" wire:model.defer="no_cookie">
                          <label for="no_cookie" class="cursor-pointer">{{ __('Privacy enhanced (only cookie when user starts video)') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="responsive" class="form-check-input" type="checkbox" wire:model.defer="responsive">
                          <label for="responsive" class="cursor-pointer">{{ __('Responsive (auto scale to available width)') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif

            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onYoutubeEmbedCodeGenerator">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeEmbedCodeGenerator">{{ __('Generate') }}</span>
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
                <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                    <div class="form-group">
                      <label class="form-label text-white">{{ __('HTML embed code') }}</label>
                      <textarea id="text" class="form-control" rows="6">{{ $data }}</textarea>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <a class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" value="copy" onclick="copyToClipboard()">{{ __('Copy HTML to clipboard') }}</a>
                    </div>
                </fieldset>

                <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                    <div class="form-group">
                        <label class="form-label text-white">{{ __('Preview') }}</label>
                    </div>
                    
                    <div class="form-group">
                      {!! $data !!}
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