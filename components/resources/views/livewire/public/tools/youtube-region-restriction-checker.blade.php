<div>

      <form wire:submit.prevent="onYoutubeRegionRestrictionChecker">

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
                        <div wire:loading.inline wire:target="onYoutubeRegionRestrictionChecker">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeRegionRestrictionChecker">{{ __('Check') }}</span>
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

        <div class="card mt-3">
            <div class="bg-gradient-success d-block text-center text-white rounded-top fw-bold p-3">
                <h6 class="text-white mb-0">{{ __('World Map') }}</h6>
            </div>

            <div class="card-body border border-success">
                @if ( !empty($this->data) )
                    <p>
                        {{ __('Video: ') }}
                        <a class="fw-bold" href="https://www.youtube.com/watch?v={{ $data['video_id'] }}" target="_blank">{{ $data['title'] }}</a>
                    </p>
                @endif
                <div wire:ignore id="world-map" style="width:100%;height:480px"></div>
            </div>
        </div>

        @if ( !empty($this->data) )
            <table class="table table-bordered mt-3">
                <thead class="bg-gradient-success text-white">
                    <tr>
                        <th>{{ __('Allowed countries') }}</th>
                        <th>{{ __('Blocked countries') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if ( !empty($allowed) )  
                                @foreach ($allowed as $value)
                                    <p>{{ $value }}</p>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ( !empty($blocked) )  
                                @foreach ($blocked as $value)
                                    <p>{{ $value }}</p>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
      </form>

        <script src="{{ asset('assets/js/jquery-jvectormap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap.css') }}">
        <script src="{{ asset('assets/js/jquery-jvectormap-world-mill.js') }}"></script>

        <script>
          jQuery(function(){
                jQuery('#world-map').vectorMap({
                    map: 'world_mill',
                    backgroundColor: 'white',
                    container: jQuery('#world-map'),
                    regionStyle: {
                        initial: { fill: "#4a9fc5" },
                        stroke: 'red'
                    },
                    zoomButtons: true,
                    series: {
                        regions: [{
                            attribute: 'fill'
                        }]
                    }
                });
          });
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

                    window.addEventListener('data', event => {

                        var world_map = jQuery('#world-map').vectorMap('get', 'mapObject');

                        var allowedArr = [];

                        var blockedArr = [];

                        var colors = {};

                        for(var code in world_map.regions){
                            
                            if ( event.detail.allowed.length > 0) {

                                if ( event.detail.allowed.indexOf(code) > -1 ) {

                                    colors[code] = "#4a9fc5";

                                    allowedArr.push(world_map.regions[code].config.name);

                                } else {

                                    colors[code] = "#ff0000";

                                    blockedArr.push(world_map.regions[code].config.name);

                                }

                            }
                            else {

                                if ( event.detail.blocked.length > 0 && event.detail.blocked.indexOf(code) > -1 ) {

                                    colors[code] = "#ff0000";

                                    blockedArr.push(world_map.regions[code].config.name);

                                } else {

                                    colors[code] = "#4a9fc5";

                                    allowedArr.push(world_map.regions[code].config.name);

                                }
                            }

                        }

                        world_map.series.regions[0].setValues(colors);

                        window.livewire.emit('onSetCountries', allowedArr, blockedArr)

                    });
                });

          })( jQuery );
        </script>
</div>