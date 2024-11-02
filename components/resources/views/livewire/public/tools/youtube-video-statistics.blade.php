<div>

      <form wire:submit.prevent="onYoutubeVideoStatistics">

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
                        <div wire:loading.inline wire:target="onYoutubeVideoStatistics">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeVideoStatistics">{{ __('Statistic') }}</span>
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
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered table-striped border mb-0">
                        <thead class="bg-gradient-success">
                            <tr>
                                <th colspan="2" class="text-center text-white h6">{{ __('Results') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Channel ID') }}</td>
                                <td>{{ $data['channelId'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Channel Title') }}</td>
                                <td>{{ $data['channelTitle'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white w-25">{{ __('Video Title') }}</td>
                                <td>{{ $data['title'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white w-25">{{ __('Video Views') }}</td>
                                <td>{{ number_format( $data['viewCount'] ) }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white w-25">{{ __('Video Likes') }}</td>
                                <td>{{ number_format( $data['likeCount'] ) }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white w-25">{{ __('Video Comments') }}</td>
                                <td>{{ number_format( $data['commentCount'] ) }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Published at') }}</td>
                                <td>{{ $data['publishedAt'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Description') }}</td>
                                <td>{{ $data['description'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Thumbnails') }}</td>
                                <td>
                                    @if (is_array($data['thumbnails']) || is_object($data['thumbnails']))
                                        @foreach ($data['thumbnails'] as $k => $v)
                                            <span class="badge bg-gradient-secondary text-lowercase">
                                                <a class="text-white" target="_blank" href="{{ $v['url'] }}">{{ $k }} ({{ $v['width'] . 'x' . $v['height'] }})</a>
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-gradient-secondary text-lowercase">{{ __('none') }}</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Tags') }}</td>
                                <td>
                                    @if (is_array($data['tags']) || is_object($data['tags']))
                                        @foreach ($data['tags'] as $element)
                                            <span class="badge bg-gradient-secondary text-lowercase">{{ $element }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-gradient-secondary text-lowercase">{{ __('none') }}</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Category') }}</td>
                                <td>{{ $data['category'] }}</td>
                            </tr>

                            <tr>
                                <td class="bg-gradient-success text-white">{{ __('Default Language') }}</td>
                                <td>{{ $data['defaultLanguage'] }}</td>
                            </tr>
                        </tbody>
                    </table>
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