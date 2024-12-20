<div>
                    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewLanguage"><i class="fas fa-plus me-1 me-1"></i> {{ __('Add New Language') }}</button>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover settings">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Language') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ( !empty($languages) )

                                @foreach ($languages as $language)

                                    <tr>
                                        <td class="align-middle">
                                            <span class="px-2">{{ $language['name'] }}</span>
                                        </td>
                                        <td class="align-middle"><span class="badge bg-{{ ($language['default']) ? 'success' : 'secondary' }}">{{ ($language['default']) ? __('Yes') : __('No') }}</span></td>
                                        <td class="align-middle"><span class="badge bg-{{ ($language['status']) ? 'success' : 'secondary' }}">{{ ($language['status']) ? __('Enabled') : __('Disabled') }}</span></td>
                                        <td class="align-middle w-50 py-3">
                                            <div class="btn-group">
                                                <a class="btn bg-gradient-secondary mb-0" title="{{ __('Set as Default') }}" wire:click="onSetDefault( {{ $language['id'] }} )">{{ __('Set as Default') }}</a>
                                                <a class="btn bg-gradient-primary mb-0" title="{{ __('Translations') }}" href="{{ route('admin.languages.translations.edit', $language['id'] ) }}"><i class="fas fa-language icon"></i> {{ __('Translations') }}</a>
                                                <a wire:click="onEnableLanguage( {{ $language['id'] }} )" class="btn bg-gradient-success mb-0" title="{{ __('Enable') }}">
                                                    <i class="fas fa-check icon"></i>
                                                    {{ __('Enable') }}
                                                </a>

                                                <a wire:click="onDisableLanguage( {{ $language['id'] }} )" class="btn bg-gradient-warning mb-0" title="{{ __('Disable') }}">
                                                    <i class="fas fa-ban icon"></i>
                                                    {{ __('Disable') }}
                                                </a>
                                                <a class="btn bg-gradient-info mb-0" title="{{ __('Edit') }}" wire:click="onShowEditLanguageModal( {{ $language['id'] }} )"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                                <a class="btn bg-gradient-danger mb-0" title="{{ __('Delete') }}" wire:click="onDeleteLanguageConfirm( {{ $language['id'] }} )"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @else

                                <tr>
                                    <td class="align-middle" colspan="4">{{ __('No record found') }}</td>
                                </tr>

                            @endif

                        </tbody>
                    </table>
                </div>
                
                @if( $languages->hasPages() )
                    <div class="mx-auto mt-3">
                        <!-- begin:pagination -->
                        {{ $languages->links() }}
                        <!-- begin:pagination -->
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Begin::Add New Language -->
    <div class="modal fade" id="addNewLanguage" tabindex="-1" role="dialog" aria-labelledby="addNewLanguageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="addNewLanguageModalLabel">{{ __('Add New Language') }}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
            @livewire('admin.settings.languages.create')

        </div>
      </div>
    </div>
    <!-- End::Add New Language -->

    <!-- Begin::Edit Language -->
    <div class="modal fade" id="editLanguage" tabindex="-1" role="dialog" aria-labelledby="editLanguageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="editLanguageModalLabel">{{ __('Edit Language') }}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            @livewire('admin.settings.languages.edit')

        </div>
      </div>
    </div>
    <!-- End::Edit Language -->

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
                window.livewire.emit('onDeleteLanguage', event.detail.id)
              }
            });

        });

    });

})( jQuery );
</script>