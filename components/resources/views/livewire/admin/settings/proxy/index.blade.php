<div>
                    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-info mb-3" data-bs-toggle="modal" data-bs-target="#addNewProxy"><i class="fas fa-plus me-1 me-1"></i> {{ __('Add New Proxy') }}</button>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover settings">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('IP') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Port') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Username') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Password') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Type') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ( $proxies->isNotEmpty() )

                                @foreach ($proxies as $proxy)
                                    <tr>
                                        <td class="align-middle">
                                            <span class="px-2">{{ $proxy['ip'] }}</span>
                                        </td>
                                        <td class="align-middle">{{ $proxy['port'] }}</td>
                                        <td class="align-middle">{{ ($proxy['username']) ? $proxy['username']: 'none' }}</td>
                                        <td class="align-middle">{{ ($proxy['password']) ? $proxy['password'] : 'none' }}</td>
                                        <td class="align-middle">{{ $proxy['type'] }}</td>
                                        <td class="align-middle">
                                            @if ( $proxy['banned'] )
                                                <span class="badge bg-danger"><i class="fas fa-times"></i></span>
                                            @else
                                                <span class="badge bg-success"><i class="fas fa-check"></i></span>
                                            @endif

                                        </td>
                                        <td class="btn-group w-100">
                                            <button class="btn bg-gradient-primary mb-0" title="{{ __('Check Proxy') }}" wire:click="onProxyCheck( {{ $proxy['id'] }} )" wire:loading.attr="disabled">
                                                <i class="fas fa-check icon" wire:loading.remove wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                <i class="fas fa-spinner fa-spin icon" wire:loading.inline wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                {{ __('Check Proxy') }}
                                            </button>
                                            <button class="btn bg-gradient-warning mb-0" title="{{ __('Disable') }}" wire:click="onDisableProxy( {{ $proxy['id'] }} )" wire:loading.attr="disabled">
                                                <i class="fas fa-times-circle icon" wire:loading.remove wire:target="onDisableProxy( {{ $proxy['id'] }} )"></i>
                                                <i class="fas fa-spinner fa-spin icon" wire:loading.inline wire:target="onDisableProxy( {{ $proxy['id'] }} )"></i>
                                                {{ __('Disable') }}
                                            </button>
                                            <button class="btn bg-gradient-info mb-0" title="{{ __('Edit') }}" wire:click="onShowEditProxyModal( {{ $proxy['id'] }} )"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</button>
                                            <button class="btn bg-gradient-danger mb-0" title="{{ __('Delete') }}" wire:click="onDeleteProxyConfirm( {{ $proxy['id'] }} )"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @else

                                <tr>
                                    <td class="align-middle" colspan="7">{{ __('No record found') }}</td>
								</tr>

                            @endif

                        </tbody>
                    </table>
                </div>
				
				@if( $proxies->hasPages() )
					<div class="mx-auto mt-3">
						<!-- begin:pagination -->
						{{ $proxies->links() }}
						<!-- begin:pagination -->
					</div>
				@endif
            </div>
        </div>
    </div>

    <!-- Begin::Add New Proxy -->
    <div class="modal fade" id="addNewProxy" tabindex="-1" role="dialog" aria-labelledby="addNewProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="addNewProxyModalLabel">{{ __('Add New Proxy') }}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          @livewire('admin.settings.proxy.create')

        </div>
      </div>
    </div>
    <!-- End::Add New Proxy -->

    <!-- Begin::Edit Proxy -->
    <div class="modal fade" id="editProxy" tabindex="-1" role="dialog" aria-labelledby="editProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="editProxyModalLabel">{{ __('Edit Proxy') }}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

           @livewire('admin.settings.proxy.edit')

        </div>
      </div>
    </div>
    <!-- End::Edit Proxy -->

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
                window.livewire.emit('onDeleteProxy', event.detail.id)
              }
            });

        });

    });

})( jQuery );
</script>