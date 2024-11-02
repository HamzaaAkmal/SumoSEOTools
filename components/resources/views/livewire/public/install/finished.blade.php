<div class="text-center">
    <i class="far fa-check-circle fa-5x text-success mx-auto my-3"></i>
    <h4 class="text-gradient text-success my-4">{{ __('Congratulations!') }}</h4>
    <p>{{ __('Your website is ready now. Login to your Admin dashboard to make changes and modify any of the default content to suit your needs.') }}</p>
    <p>{{ __('Please come back and') }}<a class="text-primary" href="https://ninealert.com/support-us"> {{ __('Want more?') }} </a>{{ __('Subscribe us for more Content.') }}</p>
    <div class="row">
        <div class="col-md-12">
          <a href="{{ route('home') }}" class="btn bg-gradient-primary my-3">{{ __('View your website!') }}</a>
      </div>
    </div>
    <small class="form-hint">{{ __('For security reasons, the system will remove the install link automatically.') }}</small>
</div>