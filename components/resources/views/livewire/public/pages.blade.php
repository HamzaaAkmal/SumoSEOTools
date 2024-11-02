@if ( $page->type == 'tool')
    <section id="tool-box">
        <div class="card mb-3">
          @if ( !$general->parallax_status )
                <div class="card-header d-block {{ ($general->heading_background !== 'bg-white') ? $general->heading_background : 'bg-transparent' }}">
                      <h1 class="page-title mb-0 h6 {{ ($general->heading_background !== 'bg-white') ? 'text-white' : ''}}">{{ __($pageTrans->title) }}</h1>
                      <p class="mb-0 {{ ($general->heading_background !== 'bg-white') ? 'text-white' : ''}}">{{ __($pageTrans->subtitle) }}</p>
                </div>
           @endif

           @livewire('public.tools', ['tool_name' => $page->tool_name])
        </div>
        
        @if ( !empty($related_tools) && $general->related_tools && $page->type == 'tool' )
            <section>
                <div class="card mb-3">
                    <div class="d-block card-header related-tools-box text-start {{ ($general->related_tools_background !== 'bg-white') ? $general->related_tools_background : 'bg-transparent' }}">
                      <h3 class="{{ ($general->related_tools_background !== 'bg-white') ? 'text-white' : ''}} mb-0 h6">{{ __('Related Tools') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          @foreach ($related_tools as $key => $value)
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            @if ( $general->icon_before_tool_name_status )
                                              <img class="avatar me-3 bg-transparent {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @if (!$general->lazy_loading) src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @endif alt="{{ $value['title'] }}">
                                            @endif
                                            <div class="fw-medium">{{ $value['title'] }}</div>
                                            @if ( $value['new'] )
                                                <div class="ribbon-wrapper fw-bold" data-ribbon="{{ __('New') }}"></div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                          @endforeach
                      </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endif