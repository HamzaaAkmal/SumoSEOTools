<div class="mt-2 d-print-none">
    <div class="align-items-center">
      <ol class="breadcrumb mb-0 {{ ( Cookie::get('theme_mode') == 'theme-dark') ? 'bg-dark' : '' }}" aria-label="breadcrumbs">
          @foreach ($breadcrumbs as $index => $breadcrumb)
              <li class="breadcrumb-item {{ $index == count($breadcrumbs) - 1 ? 'active' : '' }}" {{ $index == count($breadcrumbs) - 1 ? 'aria-current="page"' : '' }}>
                  <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
              </li>
          @endforeach
      </ol>
  </div>
</div>       