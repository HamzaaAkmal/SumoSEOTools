<div>               
    <div class="row">
        <div class="col-12">

	        <!-- begin:Add new footer translations -->
	        <div class="dropdown mb-3">
	          <a class="btn bg-gradient-primary dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLang">
	             {{ __('Add New Translations') }}
	          </a>
	          <ul class="dropdown-menu px-2 mt-5" aria-labelledby="navbarDropdownMenuLang">
	             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
	                  <li>
	                      <a class="dropdown-item" href="{{ route('admin.footer.translations.create', $properties->key()) }}">
	                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-image me-1 my-auto"> {{ $properties->native() }}
	                      </a>
	                  </li>
	              @endforeach
	          </ul>
	        </div>
	        <!-- begin:Add new footer translations -->

            <div class="card">
	            	<div class="table-responsive">
	            		<table class="table table table-hover settings">
	            			<thead>
	            				<tr>
	            					<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Language') }}</th>
	            					<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
	            				</tr>
	            			</thead>
	                        <tbody>
	                            @if ( $footer_translations->isNotEmpty() )

	                                @foreach ($footer_translations as $footer_translation)

	                                    <tr>
	                                        <td class="align-middle">
	                                        	<div class="px-2">
	                                        		<img src="{{ asset('assets/img/flags/' . $footer_translation->locale . '.svg') }}" class="lang-image mx-auto"> 
	                                        		<span>{{ localization()->getSupportedLocales()[$footer_translation->locale]->native() }}</span>
	                                        	</div>
	                                        </td>
	                                        <td class="align-middle w-25">
	                                            <a href="{{ route('admin.footer.translations.edit', $footer_translation->id) }}" class="btn bg-gradient-info mb-0" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
	                                            <a wire:click="onDeleteConfirmFooterTranslation( {{ $footer_translation->id }} )" class="btn bg-gradient-danger mb-0" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
	                                        </td>
	                                    </tr>

	                                @endforeach

	                            @else

	                                <tr>
	                                    <td colspan="2">{{ __('No record found') }}</td>
	                                </tr>
									
	                            @endif

	                        </tbody>

	            		</table>
	            	</div>
					
					@if( $footer_translations->hasPages() )
						<div class="mx-auto mt-3">
							<!-- begin:pagination -->
							{{ $footer_translations->links() }}
							<!-- begin:pagination -->
						</div>
					@endif
            </div>
        </div>

    </div>

</div>
<script>
(function( $ ) {
    "use strict";
	
	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('swal:modal', event => {

			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
				confirmButton: 'btn bg-gradient-success',
				cancelButton: 'btn bg-gradient-danger'
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: event.detail.title,
			  text: event.detail.text,
			  icon: event.detail.type,
			  showCancelButton: true,
			  confirmButtonText: "{{ __('Yes, delete it!') }}",
			  cancelButtonText: "{{ __('Cancel') }}"
			}).then((result) => {
			  if (result.isConfirmed) {
				window.livewire.emit('onDeleteFooterTranslation', event.detail.id)
			  }
			});

		});

	});

})( jQuery );
</script>