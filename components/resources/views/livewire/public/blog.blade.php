<div class="row">
  @foreach ($pageTrans as $pageTran)
        <div class="col-lg-4 col-sm-6">
          <div class="card mb-4">
            <div class="card-image border-radius-lg position-relative">
              <a href="{{ route('home') . '/blog/' . $pageTran->slug }}">
                <img class="w-100 border-radius-lg move-on-hover shadow {{ ($general->lazy_loading == true) ? 'lazyload' : '' }}" {{ ($general->lazy_loading == true) ? 'data-' : '' }}src="{{ ($pageTran->featured_image) ? $pageTran->featured_image : asset('assets/img/no-thumb.svg') }}">
              </a>
            </div>
            <div class="card-body">
              <h5>
                <a href="{{ route('home') . '/blog/' . $pageTran->slug }}" class="font-weight-bold">{{ $pageTran->title }}</a>
              </h5>
              <p>{{ $pageTran->short_description }}</p>

              <a href="{{ route('home') . '/blog/' . $pageTran->slug }}" class="text-info icon-move-right">{{ __('Read More') }}
                <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
  @endforeach

  <div class="d-flex justify-content-center">
    {{ $pageTrans->links() }}
  </div>
</div>