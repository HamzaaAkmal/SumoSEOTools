<div>

      <form wire:submit.prevent="onYoutubeDescriptionGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('About the Video') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_the_video_status">
                        </div>
                    </div>
                </div>
                
                <p class="text-sm text-white">{{ __('A Detailed explanation of what the video is about, including important keywords.') }}</p>
                <textarea wire:model.defer="about_the_video" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('Timestamps') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="timestamps_status">
                        </div>
                    </div>
                </div>

                <p class="text-sm text-white">{{ __('A breakdown of the main sections of your video by time. Similar to a Table of Contents Ideally these should actually be links to the specific time section of the video as well.') }}</p>
                <textarea wire:model.defer="timestamps" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('About the Channel') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_the_channel_status">
                        </div>
                    </div>
                </div>

                <p class="text-sm text-white">{{ __('Briefly explain the type of content you publish on your channel.') }}</p>
                <textarea wire:model.defer="about_the_channel" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('Other Recommended Videos / Playlists') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="recommended_status">
                        </div>
                    </div>
                </div>

                <textarea wire:model.defer="recommended" class="form-control" rows="4"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('About Our Products & Company') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_our_products_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="about_our_products" class="form-control" rows="4"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('Our Website') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="our_website_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="our_website" class="form-control" rows="2"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3">
                <div class="row">
                    <div class="col">
                        <h6 class="text-white">{{ __('Contact & Social') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="contact_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="contact" class="form-control" rows="9"></textarea>
            </fieldset>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif
        
        <div class="form-group mb-0 text-center">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onYoutubeDescriptionGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onYoutubeDescriptionGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
            <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                <div class="form-group">
                  <label class="text-white">{{ __('Result') }}</label>
                  <textarea id="text" class="form-control" rows="20">{{ $data }}</textarea>
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

                      var el = document.getElementById('paste');

                      if(el){

                        el.addEventListener('click', function(paste) {

                            paste = document.getElementById('paste');

                            '<i class="fas fa-trash"></i>' === paste.innerHTML ? (link.value = "", paste.innerHTML = '<i class="far fa-clipboard"></i>') : navigator.clipboard.readText().then(function(clipText) {

                                @this.set('link', clipText);

                            }, paste.innerHTML = '<i class="fas fa-trash"></i>');

                        });
                      }
                });

          })( jQuery );
        </script>
</div>