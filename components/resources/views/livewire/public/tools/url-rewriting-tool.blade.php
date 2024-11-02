<div>

      <form wire:submit.prevent="onUrlRewritingTool">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="row">
            <label class="form-label">{{ __('Enter URL') }}</label>
            <div class="form-group mb-3">
                <div class="input-group input-group-flat">
                    <input type="text" id="input" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                    <span class="input-group-text">
                        <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                          <i class="far fa-clipboard fa-fw"></i>
                        </div>
                    </span>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif

            <div class="form-group text-center mb-0">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                  <span>
                    <div wire:loading.inline wire:target="onUrlRewritingTool">
                      <x-loading />
                    </div>
                    <span wire:target="onUrlRewritingTool">{{ __('Rewrite') }}</span>
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

        @if ( !empty($data) )

              <div class="table-responsive my-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-gradient-secondary text-center text-white" colspan="2">{{ __('Type 1 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr1']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr1']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-gradient-info text-white opacity-10 p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>

              <div class="form-group position-relative">
                  <textarea class="form-control" rows="6">{{ $data['type1'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <i class="fas fa-copy"></i>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-gradient-secondary text-center text-white" colspan="2">{{ __('Type 2 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr2']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr2']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-gradient-info text-white opacity-10 p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative">
                  <textarea class="form-control" rows="6">{{ $data['type2'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <i class="fas fa-copy"></i>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-gradient-secondary text-center text-white" colspan="2">{{ __('Type 3 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr3']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr3']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-gradient-info text-white opacity-10 p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative">
                  <textarea class="form-control" rows="6">{{ $data['type3'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <i class="fas fa-copy"></i>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-gradient-secondary text-center text-white" colspan="2">{{ __('Type 4 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr4']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr4']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-gradient-info text-white opacity-10 p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative mt-3">
                  <textarea class="form-control" rows="6">{{ $data['type4'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <i class="fas fa-copy"></i>
                  </a>
              </div>
        @endif

      </form>

      <script>
          function copyToClipboard(element) {
              var text = element.parentElement.querySelector('textarea');
              text.select();
              document.execCommand("copy");
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