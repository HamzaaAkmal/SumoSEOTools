<div>
    <div class="card">
       <div class="table-responsive">
           <table class="table table-hover">
               <thead>
                   <tr>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool name') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Client IP') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Country') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Date') }}</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('History') }}</th>
                   </tr>
               </thead>
               <tbody>
                    @if ( $histories->isNotEmpty() )

                        @foreach ($histories as $history)

                            <tr>
                                <td class="align-middle">
                                    <span class="px-2">{{ $history->tool_name }}</span>
                                </td>
                                <td class="align-middle">{{ $history->client_ip }}</td>
                                <td class="align-middle">

                                    @if ( !empty( $history->flag ) && !empty( $history->country ) )
                                        <img src="{{ asset('assets/img/flags/' . $history->flag . '.png') }}" class="lang-image me-1 my-auto">
                                        {{ $history->country }}
                                    @else
                                        {{ __('Unknown') }}
                                    @endif

                                </td>
                                <td class="align-middle">{{ $history->created_at }}</td>
                                <td class="align-middle">
                                    <button wire:click="onDeleteHistory( {{ $history->id }} )" class="btn bg-gradient-danger mb-0" title="{{ __('Delete') }}">
                                        <i class="fas fa-trash icon"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </td>
                            </tr>

                        @endforeach

                    @else

                        <tr>
                            <td colspan="5">{{ __('No record found') }}</td>
                        </tr>

                    @endif
               </tbody>
           </table>
       </div>
		@if( $histories->hasPages() )
			<div class="mx-auto mt-3">
				{{ $histories->links() }}
			</div>
		@endif
    </div>                      
</div>
