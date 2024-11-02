<div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Page Name') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $auth_pages->isNotEmpty() )

                            @foreach ($auth_pages as $auth_page)

                                <tr>
                                    <td class="align-middle">
                                        <span class="px-2">{{ $auth_page->name }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-{{ ($auth_page->status) ? 'success' : 'secondary' }}">{{ ($auth_page->status) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>
                                    <td class="align-middle">{{ $auth_page->updated_at }}</td>
                                    <td class="w-25">
                                        <a wire:click="onEnablePage( {{ $auth_page->id }} )" class="btn bg-gradient-success mb-0" title="{{ __('Enable') }}">
                                            <i class="fas fa-check icon"></i>
                                            {{ __('Enable') }}
                                        </a>

                                        <a wire:click="onDisablePage( {{ $auth_page->id }} )" class="btn bg-gradient-danger mb-0" title="{{ __('Disable') }}">
                                            <i class="fas fa-ban icon"></i>
                                            {{ __('Disable') }}
                                        </a>
                                    </td>
                                </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="4">{{ __('No record found') }}</td>
                            </tr>

                        @endif
                    </tbody>
                </table>
            </div>
        </div>

</div>