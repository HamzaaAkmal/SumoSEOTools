<div>

    <form wire:submit.prevent="onOpenGraphGenerator">
        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Site Title') }}</label>
            <input type="text" class="form-control" wire:model.defer="title"/>
        </div>
   
        <div class="form-group mb-3">
            <label class="form-label">{{ __('Site Name') }}</label>
            <input type="text" class="form-control" wire:model.defer="site_name"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Site URL') }}</label>
            <input type="text" class="form-control" wire:model.defer="site_url"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Select type') }}</label>
            <select wire:model.defer="type" class="form-control form-select">
                <option value="article">{{ __('Article') }}</option>
                <option value="book">{{ __('Book') }}</option>
                <option value="books.author">{{ __('Book Author') }}</option>
                <option value="books.genre">{{ __('Book Genre') }}</option>
                <option value="business.business">{{ __('Business') }}</option>
                <option value="fitness.course">{{ __('Fitness Course') }}</option>
                <option value="music.album">{{ __('Music Album') }}</option>
                <option value="music.musician">{{ __('Music Musician') }}</option>
                <option value="music.playlist">{{ __('Music Playlist') }}</option>
                <option value="music.radio_station">{{ __('Music Radio Station') }}</option>
                <option value="music.song">{{ __('Music Song') }}</option>
                <option value="object">{{ __('Object (Generic Object)') }}</option>
                <option value="place">{{ __('Place') }}</option>
                <option value="product">{{ __('Product') }}</option>
                <option value="product.group">{{ __('Product Group') }}</option>
                <option value="product.item">{{ __('Product Item') }}</option>
                <option value="profile">{{ __('Profile') }}</option>
                <option value="quick_election.election">{{ __('Election') }}</option>
                <option value="restaurant">{{ __('Restaurant') }}</option>
                <option value="restaurant.menu">{{ __('Restaurant Menu') }}</option>
                <option value="restaurant.menu_item">{{ __('Restaurant Menu Item') }}</option>
                <option value="restaurant.menu_section">{{ __('Restaurant Menu Section') }}</option>
                <option value="video.episode">{{ __('Video Episode') }}</option>
                <option value="video.movie">{{ __('Video Movie') }}</option>
                <option value="video.tv_show">{{ __('Video TV Show') }}</option>
                <option value="video.other">{{ __('Video Other') }}</option>
                <option value="website">{{ __('Website') }}</option>
            </select>
        </div>

        <div class="form-group mb-3">
          <label class="form-label col-3 col-form-label">{{ __('Number of Images') }}</label>
          <div class="col">
            <div class="col mb-3">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model.defer="images.0">
                    @error('images.0') <span class="error">{{ $message }}</span> @enderror
                    <span class="input-group-text">
                        <button class="btn btn-sm btn-icon-only bg-success text-white rounded mb-0" wire:click.prevent="onAddImage()" title="{{ __('Add new') }}">
                            <i class="fas fa-plus fa-fw "></i>
                        </button>
                    </span>
                </div>
            </div>

            @foreach($inputs as $key => $value)
                <div class="col mb-3">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" wire:model.defer="images.{{ $value }}">
                        @error( 'images.' . $value ) <span class="error">{{ $message }}</span> @enderror
                        <span class="input-group-text">
                            <button class="btn btn-sm btn-icon-only bg-danger text-white rounded mb-0" wire:click.prevent="onDeleteImage({{ $key }})" title="{{ __('Delete') }}">
                                <i class="fas fa-trash fa-fw "></i>
                            </button>
                        </span>
                    </div>
                </div>
            @endforeach
          </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Meta description') }}</label>
            <textarea maxlength="200" wire:model.defer="description" rows="5" placeholder="{{ __('Up to 200 characters.') }}" class="form-control"></textarea>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif
        
        <div class="form-group mb-0 text-center">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onOpenGraphGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onOpenGraphGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
          <div class="form-group position-relative mt-3">
              <textarea class="form-control" rows="10" readonly>{{ $data }}</textarea>
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
</div>