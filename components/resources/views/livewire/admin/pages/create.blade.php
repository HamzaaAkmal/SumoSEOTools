<div>
    
    <form wire:submit.prevent="onCreatePage">
        <div class="modal-body">
            
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>

            <div class="form-group">
                <label for="slug" class="form-label">{{ __('Slug') }}</label>
                <div class="input-group">
                    <input class="form-control @error('slug') is-invalid @enderror" type="text" wire:model.defer="slug" id="slug" required>
                    <button type="button" class="btn bg-gradient-info mb-0" wire:click="createSlug">{{ __('Create slug') }}</button>
                </div>
                <small class="form-hint">{{ __('Generate SEO-Friendly URL Slug.') }}</small>
            </div>

            <div class="form-group">
                <label for="featured-image" class="form-label">{{ __('Featured image') }}</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="featured-image" data-input="thumbnail" class="btn bg-gradient-success featured-image rounded-0 rounded-start mb-0">
                            <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control ps-2" type="text" wire:model.defer="featured_image">
                </div>
                <small class="form-hint">{{ __('This image will show up on search engines.') }}</small>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onCreatePage">
                        <x-loading />
                    </div>
                    <span>{{ __('Add') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>

<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {

        jQuery('.featured-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

        jQuery('input#thumbnail').change(function() { 
            window.livewire.emit('onSetFeaturedImage', this.value)
        });

    });
    
})( jQuery );
</script>
