<div>

      <form wire:submit.prevent="onWhatIsMyUserAgent">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="table-responsive">
            <h6 class="p-2 text-center bg-gradient-success text-white fw-bold mb-0">{{ __('Results') }}</h6>
            <table class="table table-hover table-bordered table-striped">
                <tbody>
                    <tr>
                        <td class="bg-gradient-success text-white">{{ __('Your User Agent') }}</td>
                        <td>{{ $_SERVER['HTTP_USER_AGENT'] }}</td>
                    </tr>

                    @if ( !empty($data) )
                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Your Browser') }}</td>
                            <td>{{ $data['browser'] }}</td>
                        </tr>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Browser Version') }}</td>
                            <td>{{ $data['browser_version'] }}</td>
                        </tr>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Operating System') }}</td>
                            <td>{{ $data['os']  . ' ' . $data['os_version']}}</td>
                        </tr>

                        <tr>
                            <td class="bg-gradient-success text-white">{{ __('Languages') }}</td>
                            <td>{{ $data['languages'] }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif

        <div class="form-group mb-0 text-center">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onWhatIsMyUserAgent">
                  <x-loading />
                </div>
                <span wire:target="onWhatIsMyUserAgent">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>