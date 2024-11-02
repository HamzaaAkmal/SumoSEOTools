<div>

    <button class="btn bg-gradient-danger mb-3" wire:click="onClearHistory">
        <i class="fas fa-trash icon"></i>
        {{ __('Clear History') }}
    </button>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('URL') }}</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Response') }}</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Time') }}</th>
                    </tr>
                </thead>

               <tbody>
                    @if ( $histories->isNotEmpty() )

                        @foreach ($histories as $history)

                            <tr>
                                <td>{{ $history->url }}</td>
                                <td>{{ $history->response }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>

                        @endforeach

                    @else

                        <tr>
                            <td colspan="3">{{ __('No record found') }}</td>
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

    <div class="card mt-3">
        <div class="card-header bg-gradient-info">
            <h6 class="text-white mb-0">{{ __('Response Code Help') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Response Code') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Response Message') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Reasons') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="px-2">{{ __('200') }}</span></td>
                            <td><span class="px-2">{{ __('OK') }}</span></td>
                            <td><span class="px-2">{{ __('The URL was successfully submitted to the IndexNow API.') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="px-2">{{ __('202') }}</span></td>
                            <td><span class="px-2">{{ __('Accepted') }}</span></td>
                            <td><span class="px-2">{{ __('The URL was successfully submitted to the IndexNow API, but the API key validation is pending.') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="px-2">{{ __('400') }}</span></td>
                            <td><span class="px-2">{{ __('Bad Request') }}</span></td>
                            <td><span class="px-2">{{ __('The request was invalid.') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="px-2">{{ __('403') }}</span></td>
                            <td><span class="px-2">{{ __('Forbidden') }}</span></td>
                            <td><span class="px-2">{{ __('The key was invalid (e.g. key not found, file found but key not in the file).') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="px-2">{{ __('422') }}</span></td>
                            <td><span class="px-2">{{ __('Unprocessable Entity') }}</span></td>
                            <td><span class="px-2">{{ __('The URLs don\'t belong to the host or the key is not matching the schema in the protocol.') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="px-2">{{ __('429') }}</span></td>
                            <td><span class="px-2">{{ __('Too Many Requests') }}</span></td>
                            <td><span class="px-2">{{ __('Too Many Requests (potential Spam).') }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
