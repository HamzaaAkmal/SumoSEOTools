<div>

      <form wire:submit.prevent="onYoutubeMoneyCalculator">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
    
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Daily Views') }}</label>
                <div class="input-group input-group-flat">
                    <input type="number" class="form-control" wire:model.defer="views" required />
                </div>
                <div class="d-block mt-3" id="sliderOne" wire:ignore></div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Estimated CPM') }}</label>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="cpm_min" disabled />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="cpm_max" disabled />
                        </div>
                    </div>
                </div>

                <div class="d-block" id="sliderTwo" wire:ignore></div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
            
            <div class="form-group mb-0 text-center">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onYoutubeMoneyCalculator">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeMoneyCalculator">{{ __('Calculator') }}</span>
                    </span>
                </button>
            </div>

            @if ( !empty($data) )
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover mb-0">
                       <thead class="bg-gradient-success text-white">
                           <tr>
                                <th>{{ __('Estimated Daily Earnings') }}</th>
                                <th>{{ __('Estimated Monthly Earnings') }}</th>
                                <th>{{ __('Estimated Yearly Earnings') }}</th>
                           </tr>
                       </thead>
                       <tbody>
                            <tr>
                                <td>${{ $data['cpm_min'] }} - ${{ $data['cpm_max'] }}</td>
                                <td>${{ $data['cpm_min_monthly'] }} - ${{ $data['cpm_max_monthly'] }}</td>
                                <td>${{ $data['cpm_min_yearly'] }} - ${{ $data['cpm_max_yearly'] }}</td>
                            </tr>
                       </tbody>
                    </table>
                </div>
            @endif

      </form>

        <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
        <script src="{{ asset('assets/js/wNumb.min.js') }}"></script>

        <script>
        (function( $ ) {
            "use strict";

            document.addEventListener('livewire:load', function () {

                var sliderOne = document.getElementById('sliderOne');

                noUiSlider.create(sliderOne, {
                    start: [10000],
                    connect: true,
                    range: {
                        'min': 0,
                        'max': 10000000
                    },
                    format: wNumb({
                        decimals: 0
                    })
                });

                sliderOne.noUiSlider.on('update', function (values) {
                    window.livewire.emit('onSetViews', values[0]);
                });

                //
                
                var sliderTwo = document.getElementById('sliderTwo');

                noUiSlider.create(sliderTwo, {
                    start: [0.25, 4],
                    step: 0.05,
                    connect: true,
                    range: {
                        'min': 0.1,
                        'max': 10
                    },
                    format: wNumb({
                        decimals: 2
                    })
                });

                sliderTwo.noUiSlider.on('update', function (values) {
                    window.livewire.emit('onSetMin', values[0]);
                    window.livewire.emit('onSetMax', values[1]);
                });

            });

        })( jQuery );
        </script>
</div>
