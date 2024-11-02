<div>

        <button class="btn bg-gradient-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus me-1 me-1"></i> {{ __('Add New Page') }}</button>

        <!-- begin:Form Search -->
        <form id="formSearchPage">
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
            </div>
        </form>
        <!-- end:Form Search -->

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Slug') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Type') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default Language') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Translation Progress') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('ADS') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $pages->isNotEmpty() )

                            @foreach ($pages as $page)

                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <img src="{{ ($page->featured_image) ? $page->featured_image : asset('assets/img/no-thumb.svg') }}" class="avatar avatar-sm me-3">
                                            <div class="d-flex align-items-center">{{ $page->slug }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $page->type }}</td>
                                    <td class="align-middle">
                                        <img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-image mx-auto"> 
                                    </td>

                                    <td class="align-middle">
                                        @if (count( $page->translations ) == $total_lang)
                                            <span class="badge bg-success">{{ count( $page->translations ) }}/{{ $total_lang }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ count( $page->translations ) }}/{{ $total_lang }}</span>
                                        @endif
                                    </td>
                                    
                                    <td class="align-middle">
                                        <span class="badge bg-{{ ($page->page_status) ? 'success' : 'secondary' }}">{{ ($page->page_status) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>

                                    <td class="align-middle">
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" wire:click="onAds({{ $page->id }}, {{ $page->ads_status ? 'true' : 'false' }})" {{ $page->ads_status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    
                                    <td class="align-middle">
                                        <span>{{ $page->updated_at }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @switch( $page->type )
                                            @case('page')
                                                <div class="btn-group w-100">
                                                    <a href="{{ route('admin.pages.translations.index', $page->id ) }}" class="btn bg-gradient-primary" title="{{ __('Translations') }}"><i class="fas fa-language icon"></i> Translations</a>
                                                    <a wire:click="onEnablePage( {{ $page->id }} )" class="btn bg-gradient-success mb-0" title="{{ __('Enable') }}">
                                                        <i class="fas fa-check icon"></i>
                                                        {{ __('Enable') }}
                                                    </a>

                                                    <a wire:click="onDisablePage( {{ $page->id }} )" class="btn bg-gradient-warning mb-0" title="{{ __('Disable') }}">
                                                        <i class="fas fa-ban icon"></i>
                                                        {{ __('Disable') }}
                                                    </a>
                                                    <a wire:click="onShowEditPageModal( {{ $page->id }} )" class="btn bg-gradient-info mb-0" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                                    <a wire:click="onDeleteConfirmPage( {{ $page->id }} )" class="btn bg-gradient-danger mb-0" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
                                                </div>
                                                @break

                                            @case('contact')
                                            @case('report')
                                            @case('home')
                                                <div class="btn-group w-100">
                                                    <a href="{{ route('admin.pages.translations.index', $page->id ) }}" class="btn bg-gradient-primary mb-0" title="{{ __('Translations') }}"><i class="fas fa-language icon"></i> Translations</a>
                                                    <a wire:click="onEnablePage( {{ $page->id }} )" class="btn bg-gradient-success mb-0" title="{{ __('Enable') }}">
                                                        <i class="fas fa-check icon"></i>
                                                        {{ __('Enable') }}
                                                    </a>

                                                    <a wire:click="onDisablePage( {{ $page->id }} )" class="btn bg-gradient-warning mb-0" title="{{ __('Disable') }}">
                                                        <i class="fas fa-ban icon"></i>
                                                        {{ __('Disable') }}
                                                    </a>
                                                    <a wire:click="onShowEditPageModal( {{ $page->id }} )" class="btn bg-gradient-info mb-0" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                                </div>
                                                @break
                                        @endswitch

                                    </td>
                                </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="8">{{ __('No record found') }}</td>
                            </tr>

                        @endif

                    </tbody>
                </table>
            </div>
			@if( $pages->hasPages() )
				<div class="mx-auto mt-3">
					<!-- begin:pagination -->
					{{ $pages->links() }}
					<!-- begin:pagination -->
				</div>
			@endif
        </div>

        <!-- Begin::Add New Page -->
        <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Page') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @livewire('admin.pages.create')

            </div>
          </div>
        </div>
        <!-- End::Add New Page -->

        <!-- Begin::Edit Page -->
        <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="editPageModalLabel">{{ __('Edit Page') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @livewire('admin.pages.edit')
              
            </div>
          </div>
        </div>
        <!-- End::Edit Page -->

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
                window.livewire.emit('onDeletePage', event.detail.id)
              }
            });
    
        });

    });

})( jQuery );
</script>