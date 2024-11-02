<div class="nav-item d-flex mb-0">
    <button id="search-icon" class="btn btn-icon-only mb-0 me-2 bg-white btn-toggle-dir" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Search box') }}" data-bs-original-title="{{ __('Search box') }}" type="button">
        <i class="fas fa-search text-primary"></i>
    </button>

    <div id="search-box" class="search-box" wire:ignore.self>
        <div class="form-group position-relative w-100 mb-0">
            <span class="input-group-text position-absolute z-index-1 border-0 d-block bg-transparent">
                <span wire:loading wire:target="onSearch" class="spinner-border spinner-border-sm me-2" role="status"></span>
                <i wire:loading.remove wire:target="onSearch" class="fas fa-search"></i>
            </span>
            <input type="text" class="form-control rounded-0 ps-5" wire:model="searchQuery" wire:input="onSearch" placeholder="{{ __('Search for your tool') }}">
        </div>

        @if ( !empty($search_queries) && !empty($searchQuery) )
            <div class="card rounded-0 overflow-auto" style="max-height: 18rem">
              <div class="card-body pb-0">
                <div class="row">
                    @foreach ($search_queries as $key => $value)
                      <div class="col-12 col-md-6 col-lg-4 mb-3">
                          <a class="card text-decoration-none cursor-pointer item-box" href="{{ (empty($value['custom_tool_link'])) ? route('home') . '/' . app()->getLocale() . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
                              <div class="card-body">
                                  <div class="d-flex align-items-center">
                                      <div class="fw-medium">{{ $value['title'] }}</div>
                                  </div>
                              </div>
                          </a>
                      </div>
                    @endforeach
                </div>
              </div>
            </div>
        @endif
    </div>
</div>