<div class="page page-center">
    <div class="container-tight py-5">
        <div class="text-center">
          <div class="empty-img">
            <img src="{{ asset('assets/img/disabled.svg') }}" height="128">
          </div>
            <p class="my-3">{{ __('User') }} {{ __($message) }} {{ __('is currently not allowed') }}. </p>
            <div class="empty-action">
                <a href="{{ route('home') }}" class="btn bg-gradient-primary">
                    <i class="fas fa-arrow-left icon"></i>
                    {{ __('Go to Homepage') }}
                </a>
            </div>
        </div>
    </div>
</div>