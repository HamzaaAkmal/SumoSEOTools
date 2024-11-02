<div>

      <form wire:submit.prevent="onYoutubeTrend">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="row">

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Language') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select class="form-control form-select" wire:model.defer="lang" required>
                              <option value="AF">{{ __('Afrikaans') }}</option>
                              <option value="SQ">{{ __('Albanian') }}</option>
                              <option value="AR">{{ __('Arabic') }}</option>
                              <option value="HY">{{ __('Armenian') }}</option>
                              <option value="EU">{{ __('Basque') }}</option>
                              <option value="BN">{{ __('Bengali') }}</option>
                              <option value="BG">{{ __('Bulgarian') }}</option>
                              <option value="CA">{{ __('Catalan') }}</option>
                              <option value="KM">{{ __('Cambodian') }}</option>
                              <option value="ZH">{{ __('Chinese (Mandarin)') }}</option>
                              <option value="HR">{{ __('Croatian') }}</option>
                              <option value="CS">{{ __('Czech') }}</option>
                              <option value="DA">{{ __('Danish') }}</option>
                              <option value="NL">{{ __('Dutch') }}</option>
                              <option value="EN">{{ __('English') }}</option>
                              <option value="ET">{{ __('Estonian') }}</option>
                              <option value="FJ">{{ __('Fiji') }}</option>
                              <option value="FI">{{ __('Finnish') }}</option>
                              <option value="FR">{{ __('French') }}</option>
                              <option value="KA">{{ __('Georgian') }}</option>
                              <option value="DE">{{ __('German') }}</option>
                              <option value="EL">{{ __('Greek') }}</option>
                              <option value="GU">{{ __('Gujarati') }}</option>
                              <option value="HE">{{ __('Hebrew') }}</option>
                              <option value="HI">{{ __('Hindi') }}</option>
                              <option value="HU">{{ __('Hungarian') }}</option>
                              <option value="IS">{{ __('Icelandic') }}</option>
                              <option value="ID">{{ __('Indonesian') }}</option>
                              <option value="GA">{{ __('Irish') }}</option>
                              <option value="IT">{{ __('Italian') }}</option>
                              <option value="JA">{{ __('Japanese') }}</option>
                              <option value="JW">{{ __('Javanese') }}</option>
                              <option value="KO">{{ __('Korean') }}</option>
                              <option value="LA">{{ __('Latin') }}</option>
                              <option value="LV">{{ __('Latvian') }}</option>
                              <option value="LT">{{ __('Lithuanian') }}</option>
                              <option value="MK">{{ __('Macedonian') }}</option>
                              <option value="MS">{{ __('Malay') }}</option>
                              <option value="ML">{{ __('Malayalam') }}</option>
                              <option value="MT">{{ __('Maltese') }}</option>
                              <option value="MI">{{ __('Maori') }}</option>
                              <option value="MR">{{ __('Marathi') }}</option>
                              <option value="MN">{{ __('Mongolian') }}</option>
                              <option value="NE">{{ __('Nepali') }}</option>
                              <option value="NO">{{ __('Norwegian') }}</option>
                              <option value="FA">{{ __('Persian') }}</option>
                              <option value="PL">{{ __('Polish') }}</option>
                              <option value="PT">{{ __('Portuguese') }}</option>
                              <option value="PA">{{ __('Punjabi') }}</option>
                              <option value="QU">{{ __('Quechua') }}</option>
                              <option value="RO">{{ __('Romanian') }}</option>
                              <option value="RU">{{ __('Russian') }}</option>
                              <option value="SM">{{ __('Samoan') }}</option>
                              <option value="SR">{{ __('Serbian') }}</option>
                              <option value="SK">{{ __('Slovak') }}</option>
                              <option value="SL">{{ __('Slovenian') }}</option>
                              <option value="ES">{{ __('Spanish') }}</option>
                              <option value="SW">{{ __('Swahili') }}</option>
                              <option value="SV">{{ __('Swedish ') }}</option>
                              <option value="TA">{{ __('Tamil') }}</option>
                              <option value="TT">{{ __('Tatar') }}</option>
                              <option value="TE">{{ __('Telugu') }}</option>
                              <option value="TH">{{ __('Thai') }}</option>
                              <option value="BO">{{ __('Tibetan') }}</option>
                              <option value="TO">{{ __('Tonga') }}</option>
                              <option value="TR">{{ __('Turkish') }}</option>
                              <option value="UK">{{ __('Ukrainian') }}</option>
                              <option value="UR">{{ __('Urdu') }}</option>
                              <option value="UZ">{{ __('Uzbek') }}</option>
                              <option value="VI">{{ __('Vietnamese') }}</option>
                              <option value="CY">{{ __('Welsh') }}</option>
                              <option value="XH">{{ __('Xhosa') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Country') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select class="form-control form-select" wire:model.defer="country" required>
                            <option value="DZ">{{ __('Algeria') }}</option>
                            <option value="AR">{{ __('Argentina') }}</option>
                            <option value="AU">{{ __('Australia') }}</option>
                            <option value="AT">{{ __('Austria') }}</option>
                            <option value="AZ">{{ __('Azerbaijan') }}</option>
                            <option value="BH">{{ __('Bahrain') }}</option>
                            <option value="BD">{{ __('Bangladesh') }}</option>
                            <option value="BY">{{ __('Belarus') }}</option>
                            <option value="BE">{{ __('Belgium') }}</option>
                            <option value="BO">{{ __('Bolivia') }}</option>
                            <option value="BA">{{ __('Bosnia and Herzegovina') }}</option>
                            <option value="BR">{{ __('Brazil') }}</option>
                            <option value="BG">{{ __('Bulgaria') }}</option>
                            <option value="CA">{{ __('Canada') }}</option>
                            <option value="CL">{{ __('Chile') }}</option>
                            <option value="CO">{{ __('Colombia') }}</option>
                            <option value="CR">{{ __('Costa Rica') }}</option>
                            <option value="HR">{{ __('Croatia') }}</option>
                            <option value="CY">{{ __('Cyprus') }}</option>
                            <option value="CZ">{{ __('Czechia') }}</option>
                            <option value="DK">{{ __('Denmark') }}</option>
                            <option value="DO">{{ __('Dominican Republic') }}</option>
                            <option value="EC">{{ __('Ecuador') }}</option>
                            <option value="EG">{{ __('Egypt') }}</option>
                            <option value="SV">{{ __('El Salvador') }}</option>
                            <option value="EE">{{ __('Estonia') }}</option>
                            <option value="FI">{{ __('Finland') }}</option>
                            <option value="FR">{{ __('France') }}</option>
                            <option value="GE">{{ __('Georgia') }}</option>
                            <option value="DE">{{ __('Germany') }}</option>
                            <option value="GH">{{ __('Ghana') }}</option>
                            <option value="GR">{{ __('Greece') }}</option>
                            <option value="GT">{{ __('Guatemala') }}</option>
                            <option value="HN">{{ __('Honduras') }}</option>
                            <option value="HU">{{ __('Hong Kong') }}</option>
                            <option value="IS">{{ __('Iceland') }}</option>
                            <option value="IN">{{ __('India') }}</option>
                            <option value="ID">{{ __('Indonesia') }}</option>
                            <option value="IQ">{{ __('Iraq') }}</option>
                            <option value="IE">{{ __('Ireland') }}</option>
                            <option value="IT">{{ __('Italy') }}</option>
                            <option value="JM">{{ __('Jamaica') }}</option>
                            <option value="JP">{{ __('Japan') }}</option>
                            <option value="JO">{{ __('Jordan') }}</option>
                            <option value="KZ">{{ __('Kazakhstan') }}</option>
                            <option value="KE">{{ __('Kenya') }}</option>
                            <option value="KW">{{ __('Kuwait') }}</option>
                            <option value="LV">{{ __('Latvia') }}</option>
                            <option value="LB">{{ __('Lebanon') }}</option>
                            <option value="LY">{{ __('Libya') }}</option>
                            <option value="LI">{{ __('Liechtenstein') }}</option>
                            <option value="LT">{{ __('Lithuania') }}</option>
                            <option value="LU">{{ __('Luxembourg') }}</option>
                            <option value="MY">{{ __('Malaysia') }}</option>
                            <option value="MT">{{ __('Malta') }}</option>
                            <option value="MX">{{ __('Mexico') }}</option>
                            <option value="ME">{{ __('Montenegro') }}</option>
                            <option value="MA">{{ __('Morocco') }}</option>
                            <option value="NP">{{ __('Nepal') }}</option>
                            <option value="NL">{{ __('Netherlands') }}</option>
                            <option value="NZ">{{ __('New Zealand') }}</option>
                            <option value="NI">{{ __('Nicaragua') }}</option>
                            <option value="NG">{{ __('Nigeria') }}</option>
                            <option value="MK">{{ __('North Macedonia') }}</option>
                            <option value="NO">{{ __('Norway') }}</option>
                            <option value="OM">{{ __('Oman') }}</option>
                            <option value="PK">{{ __('Pakistan') }}</option>
                            <option value="PA">{{ __('Panama') }}</option>
                            <option value="PG">{{ __('Papua New Guinea') }}</option>
                            <option value="PY">{{ __('Paraguay') }}</option>
                            <option value="PE">{{ __('Peru') }}</option>
                            <option value="PH">{{ __('Philippines') }}</option>
                            <option value="PL">{{ __('Poland') }}</option>
                            <option value="PT">{{ __('Portugal') }}</option>
                            <option value="PR">{{ __('Puerto Rico') }}</option>
                            <option value="QA">{{ __('Qatar') }}</option>
                            <option value="RO">{{ __('Romania') }}</option>
                            <option value="RU">{{ __('Russia') }}</option>
                            <option value="SA">{{ __('Saudi Arabia') }}</option>
                            <option value="SN">{{ __('Senegal') }}</option>
                            <option value="RS">{{ __('Serbia') }}</option>
                            <option value="SG">{{ __('Singapore') }}</option>
                            <option value="SK">{{ __('Slovakia') }}</option>
                            <option value="SI">{{ __('Slovenia') }}</option>
                            <option value="ZA">{{ __('South Africa') }}</option>
                            <option value="KR">{{ __('South Korea') }}</option>
                            <option value="ES">{{ __('Spain') }}</option>
                            <option value="LK">{{ __('Sri Lanka') }}</option>
                            <option value="SE">{{ __('Sweden') }}</option>
                            <option value="CH">{{ __('Switzerland') }}</option>
                            <option value="TW">{{ __('Taiwan') }}</option>
                            <option value="TZ">{{ __('Tanzania') }}</option>
                            <option value="TH">{{ __('Thailand') }}</option>
                            <option value="TN">{{ __('Tunisia') }}</option>
                            <option value="TR">{{ __('Turkey') }}</option>
                            <option value="UG">{{ __('Uganda') }}</option>
                            <option value="UA">{{ __('Ukraine') }}</option>
                            <option value="AE">{{ __('United Arab Emirates') }}</option>
                            <option value="GB">{{ __('United Kingdom') }}</option>
                            <option value="US">{{ __('United States') }}</option>
                            <option value="UY">{{ __('Uruguay') }}</option>
                            <option value="VE">{{ __('Venezuela') }}</option>
                            <option value="VN">{{ __('Vietnam') }}</option>
                            <option value="YE">{{ __('Yemen') }}</option>
                            <option value="ZW">{{ __('Zimbabwe') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Result') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="number" class="form-control" wire:model.defer="result" required>
                    </div>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
        
            <div class="mx-auto d-block">
                <div class="form-group mb-0 text-center">
                    <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onYoutubeTrend">
                                <x-loading />
                            </div>
                            <span wire:target="onYoutubeTrend">{{ __('Search') }}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        @if ( !empty($data) )

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                   <thead class="bg-gradient-success text-white">
                       <tr>
                           <th>{{ __('#') }}</th>
                           <th>{{ __('Thumbnail') }}</th>
                           <th>{{ __('Video') }}</th>
                           <th>{{ __('Video Tags') }}</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach ($data as $key => $value)
                           <tr>
                               <td>{{ $loop->index + 1 }}</td>
                               <td><img src="{{ $value['thumbnail'] }}" class="img-fluid" alt="{{ $value['title'] }}"></td>
                               <td><a href="{{ $value['link'] }}" title="{{ $value['title'] }}">{{ $value['title'] }}</a></td>
                               <td class="badges-list">
                                @if ( !empty($value['tags'][0]) )
                                    @foreach ($value['tags'][0] as $element)
                                        <span class="badge bg-gradient-secondary text-lowercase">{{ $element }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-gradient-secondary text-lowercase">{{ __('None') }}</span>
                                @endif

                               </td>
                           </tr>
                        @endforeach
                   </tbody>
                </table>
            </div>

        @endif

      </form>
</div>