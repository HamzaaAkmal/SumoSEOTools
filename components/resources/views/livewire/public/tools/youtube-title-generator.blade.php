<div>

      <form wire:submit.prevent="onYoutubeTitleGenerator">

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
                            <label class="form-label col-form-label">{{ __('Enter your keyword') }}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group input-group-flat">
                                <input type="text" id="input" class="form-control" wire:model.defer="query" placeholder="seo" required />
                                <span class="input-group-text">
                                    <div id="paste" class="cursor-pointer" title="{{ __('Paste') }}" data-bs-original-title="{{ __('Paste') }}" data-bs-toggle="tooltip" wire:ignore>
                                      <i class="far fa-clipboard fa-fw"></i>
                                    </div>
                                </span>
                            </div>
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
                                <option value="us">{{ __('United States (us)') }}</option>
                                <option value="af">{{ __('Afghanistan (af)') }}</option>
                                <option value="ax">{{ __('Aland Islands (ax)') }}</option>
                                <option value="al">{{ __('Albania (al)') }}</option>
                                <option value="dz">{{ __('Algeria (dz)') }}</option>
                                <option value="as">{{ __('American Samoa (as)') }}</option>
                                <option value="ad">{{ __('Andorra (ad)') }}</option>
                                <option value="ao">{{ __('Angola (ao)') }}</option>
                                <option value="ai">{{ __('Anguilla (ai)') }}</option>
                                <option value="aq">{{ __('Antarctica (aq)') }}</option>
                                <option value="ag">{{ __('Antigua and Barbuda (ag)') }}</option>
                                <option value="ar">{{ __('Argentina (ar)') }}</option>
                                <option value="am">{{ __('Armenia (am)') }}</option>
                                <option value="aw">{{ __('Aruba (aw)') }}</option>
                                <option value="au">{{ __('Australia (au)') }}</option>
                                <option value="at">{{ __('Austria (at)') }}</option>
                                <option value="az">{{ __('Azerbaijan (az)') }}</option>
                                <option value="bs">{{ __('Bahamas (bs)') }}</option>
                                <option value="bh">{{ __('Bahrain (bh)') }}</option>
                                <option value="bd">{{ __('Bangladesh (bd)') }}</option>
                                <option value="bb">{{ __('Barbados (bb)') }}</option>
                                <option value="by">{{ __('Belarus (by)') }}</option>
                                <option value="be">{{ __('Belgium (be)') }}</option>
                                <option value="bz">{{ __('Belize (bz)') }}</option>
                                <option value="bj">{{ __('Benin (bj)') }}</option>
                                <option value="bm">{{ __('Bermuda (bm)') }}</option>
                                <option value="bt">{{ __('Bhutan (bt)') }}</option>
                                <option value="bo">{{ __('Bolivia, Plurinational State of (bo)') }}</option>
                                <option value="bq">{{ __('Bonaire, Sint Eustatius and Saba (bq)') }}</option>
                                <option value="ba">{{ __('Bosnia and Herzegovina (ba)') }}</option>
                                <option value="bw">{{ __('Botswana (bw)') }}</option>
                                <option value="bv">{{ __('Bouvet Island (bv)') }}</option>
                                <option value="br">{{ __('Brazil (br)') }}</option>
                                <option value="io">{{ __('British Indian Ocean Territory (io)') }}</option>
                                <option value="bn">{{ __('Brunei Darussalam (bn)') }}</option>
                                <option value="bg">{{ __('Bulgaria (bg)') }}</option>
                                <option value="bf">{{ __('Burkina Faso (bf)') }}</option>
                                <option value="bi">{{ __('Burundi (bi)') }}</option>
                                <option value="kh">{{ __('Cambodia (kh)') }}</option>
                                <option value="cm">{{ __('Cameroon (cm)') }}</option>
                                <option value="ca">{{ __('Canada (ca)') }}</option>
                                <option value="cv">{{ __('Cape Verde (cv)') }}</option>
                                <option value="ky">{{ __('Cayman Islands (ky)') }}</option>
                                <option value="cf">{{ __('Central African Republic (cf)') }}</option>
                                <option value="td">{{ __('Chad (td)') }}</option>
                                <option value="cl">{{ __('Chile (cl)') }}</option>
                                <option value="cn">{{ __('China (cn)') }}</option>
                                <option value="cx">{{ __('Christmas Island (cx)') }}</option>
                                <option value="cc">{{ __('Cocos (Keeling) Islands (cc)') }}</option>
                                <option value="co">{{ __('Colombia (co)') }}</option>
                                <option value="km">{{ __('Comoros (km)') }}</option>
                                <option value="cg">{{ __('Congo (cg)') }}</option>
                                <option value="cd">{{ __('Congo, the Democratic Republic of the (cd)') }}</option>
                                <option value="ck">{{ __('Cook Islands (ck)') }}</option>
                                <option value="cr">{{ __('Costa Rica (cr)') }}</option>
                                <option value="ci">{{ __('Côte d\'Ivoire (ci)') }}</option>
                                <option value="hr">{{ __('Croatia (hr)') }}</option>
                                <option value="cu">{{ __('Cuba (cu)') }}</option>
                                <option value="cw">{{ __('Curaçao (cw)') }}</option>
                                <option value="cy">{{ __('Cyprus (cy)') }}</option>
                                <option value="cz">{{ __('Czech Republic (cz)') }}</option>
                                <option value="dk">{{ __('Denmark (dk)') }}</option>
                                <option value="dj">{{ __('Djibouti (dj)') }}</option>
                                <option value="dm">{{ __('Dominica (dm)') }}</option>
                                <option value="do">{{ __('Dominican Republic (do)') }}</option>
                                <option value="ec">{{ __('Ecuador (ec)') }}</option>
                                <option value="eg">{{ __('Egypt (eg)') }}</option>
                                <option value="sv">{{ __('El Salvador (sv)') }}</option>
                                <option value="gq">{{ __('Equatorial Guinea (gq)') }}</option>
                                <option value="er">{{ __('Eritrea (er)') }}</option>
                                <option value="ee">{{ __('Estonia (ee)') }}</option>
                                <option value="et">{{ __('Ethiopia (et)') }}</option>
                                <option value="fk">{{ __('Falkland Islands (Malvinas) (fk)') }}</option>
                                <option value="fo">{{ __('Faroe Islands (fo)') }}</option>
                                <option value="fj">{{ __('Fiji (fj)') }}</option>
                                <option value="fi">{{ __('Finland (fi)') }}</option>
                                <option value="fr">{{ __('France (fr)') }}</option>
                                <option value="gf">{{ __('French Guiana (gf)') }}</option>
                                <option value="pf">{{ __('French Polynesia (pf)') }}</option>
                                <option value="tf">{{ __('French Southern Territories (tf)') }}</option>
                                <option value="ga">{{ __('Gabon (ga)') }}</option>
                                <option value="gm">{{ __('Gambia (gm)') }}</option>
                                <option value="ge">{{ __('Georgia (ge)') }}</option>
                                <option value="de">{{ __('Germany (de)') }}</option>
                                <option value="gh">{{ __('Ghana (gh)') }}</option>
                                <option value="gi">{{ __('Gibraltar (gi)') }}</option>
                                <option value="gr">{{ __('Greece (gr)') }}</option>
                                <option value="gl">{{ __('Greenland (gl)') }}</option>
                                <option value="gd">{{ __('Grenada (gd)') }}</option>
                                <option value="gp">{{ __('Guadeloupe (gp)') }}</option>
                                <option value="gu">{{ __('Guam (gu)') }}</option>
                                <option value="gt">{{ __('Guatemala (gt)') }}</option>
                                <option value="gg">{{ __('Guernsey (gg)') }}</option>
                                <option value="gn">{{ __('Guinea (gn)') }}</option>
                                <option value="gw">{{ __('Guinea-Bissau (gw)') }}</option>
                                <option value="gy">{{ __('Guyana (gy)') }}</option>
                                <option value="ht">{{ __('Haiti (ht)') }}</option>
                                <option value="hm">{{ __('Heard Island and McDonald Islands (hm)') }}</option>
                                <option value="va">{{ __('Holy See (Vatican City State) (va)') }}</option>
                                <option value="hn">{{ __('Honduras (hn)') }}</option>
                                <option value="hk">{{ __('Hong Kong (hk)') }}</option>
                                <option value="hu">{{ __('Hungary (hu)') }}</option>
                                <option value="is">{{ __('Iceland (is)') }}</option>
                                <option value="in">{{ __('India (in)') }}</option>
                                <option value="id">{{ __('Indonesia (id)') }}</option>
                                <option value="ir">{{ __('Iran, Islamic Republic of (ir)') }}</option>
                                <option value="iq">{{ __('Iraq (iq)') }}</option>
                                <option value="ie">{{ __('Ireland (ie)') }}</option>
                                <option value="im">{{ __('Isle of Man (im)') }}</option>
                                <option value="il">{{ __('Israel (il)') }}</option>
                                <option value="it">{{ __('Italy (it)') }}</option>
                                <option value="jm">{{ __('Jamaica (jm)') }}</option>
                                <option value="jp">{{ __('Japan (jp)') }}</option>
                                <option value="je">{{ __('Jersey (je)') }}</option>
                                <option value="jo">{{ __('Jordan (jo)') }}</option>
                                <option value="kz">{{ __('Kazakhstan (kz)') }}</option>
                                <option value="ke">{{ __('Kenya (ke)') }}</option>
                                <option value="ki">{{ __('Kiribati (ki)') }}</option>
                                <option value="kp">{{ __('Korea, Democratic People\'s Republic of (kp)') }}</option>
                                <option value="kr">{{ __('Korea, Republic of (kr)') }}</option>
                                <option value="kw">{{ __('Kuwait (kw)') }}</option>
                                <option value="kg">{{ __('Kyrgyzstan (kg)') }}</option>
                                <option value="la">{{ __('Lao People\'s Democratic Republic (la)') }}</option>
                                <option value="lv">{{ __('Latvia (lv)') }}</option>
                                <option value="lb">{{ __('Lebanon (lb)') }}</option>
                                <option value="ls">{{ __('Lesotho (ls)') }}</option>
                                <option value="lr">{{ __('Liberia (lr)') }}</option>
                                <option value="ly">{{ __('Libya (ly)') }}</option>
                                <option value="li">{{ __('Liechtenstein (li)') }}</option>
                                <option value="lt">{{ __('Lithuania (lt)') }}</option>
                                <option value="lu">{{ __('Luxembourg (lu)') }}</option>
                                <option value="mo">{{ __('Macao (mo)') }}</option>
                                <option value="mk">{{ __('Macedonia, the former Yugoslav Republic of (mk)') }}</option>
                                <option value="mg">{{ __('Madagascar (mg)') }}</option>
                                <option value="mw">{{ __('Malawi (mw)') }}</option>
                                <option value="my">{{ __('Malaysia (my)') }}</option>
                                <option value="mv">{{ __('Maldives (mv)') }}</option>
                                <option value="ml">{{ __('Mali (ml)') }}</option>
                                <option value="mt">{{ __('Malta (mt)') }}</option>
                                <option value="mh">{{ __('Marshall Islands (mh)') }}</option>
                                <option value="mq">{{ __('Martinique (mq)') }}</option>
                                <option value="mr">{{ __('Mauritania (mr)') }}</option>
                                <option value="mu">{{ __('Mauritius (mu)') }}</option>
                                <option value="yt">{{ __('Mayotte (yt)') }}</option>
                                <option value="mx">{{ __('Mexico (mx)') }}</option>
                                <option value="fm">{{ __('Micronesia, Federated States of (fm)') }}</option>
                                <option value="md">{{ __('Moldova, Republic of (md)') }}</option>
                                <option value="mc">{{ __('Monaco (mc)') }}</option>
                                <option value="mn">{{ __('Mongolia (mn)') }}</option>
                                <option value="me">{{ __('Montenegro (me)') }}</option>
                                <option value="ms">{{ __('Montserrat (ms)') }}</option>
                                <option value="ma">{{ __('Morocco (ma)') }}</option>
                                <option value="mz">{{ __('Mozambique (mz)') }}</option>
                                <option value="mm">{{ __('Myanmar (mm)') }}</option>
                                <option value="na">{{ __('Namibia (na)') }}</option>
                                <option value="nr">{{ __('Nauru (nr)') }}</option>
                                <option value="np">{{ __('Nepal (np)') }}</option>
                                <option value="nl">{{ __('Netherlands (nl)') }}</option>
                                <option value="nc">{{ __('New Caledonia (nc)') }}</option>
                                <option value="nz">{{ __('New Zealand (nz)') }}</option>
                                <option value="ni">{{ __('Nicaragua (ni)') }}</option>
                                <option value="ne">{{ __('Niger (ne)') }}</option>
                                <option value="ng">{{ __('Nigeria (ng)') }}</option>
                                <option value="nu">{{ __('Niue (nu)') }}</option>
                                <option value="nf">{{ __('Norfolk Island (nf)') }}</option>
                                <option value="mp">{{ __('Northern Mariana Islands (mp)') }}</option>
                                <option value="no">{{ __('Norway (no)') }}</option>
                                <option value="om">{{ __('Oman (om)') }}</option>
                                <option value="pk">{{ __('Pakistan (pk)') }}</option>
                                <option value="pw">{{ __('Palau (pw)') }}</option>
                                <option value="ps">{{ __('Palestinian Territory, Occupied (ps)') }}</option>
                                <option value="pa">{{ __('Panama (pa)') }}</option>
                                <option value="pg">{{ __('Papua New Guinea (pg)') }}</option>
                                <option value="py">{{ __('Paraguay (py)') }}</option>
                                <option value="pe">{{ __('Peru (pe)') }}</option>
                                <option value="ph">{{ __('Philippines (ph)') }}</option>
                                <option value="pn">{{ __('Pitcairn (pn)') }}</option>
                                <option value="pl">{{ __('Poland (pl)') }}</option>
                                <option value="pt">{{ __('Portugal (pt)') }}</option>
                                <option value="pr">{{ __('Puerto Rico (pr)') }}</option>
                                <option value="qa">{{ __('Qatar (qa)') }}</option>
                                <option value="re">{{ __('Réunion (re)') }}</option>
                                <option value="ro">{{ __('Romania (ro)') }}</option>
                                <option value="ru">{{ __('Russian Federation (ru)') }}</option>
                                <option value="rw">{{ __('Rwanda (rw)') }}</option>
                                <option value="bl">{{ __('Saint Barthélemy (bl)') }}</option>
                                <option value="sh">{{ __('Saint Helena, Ascension and Tristan da Cunha (sh)') }}</option>
                                <option value="kn">{{ __('Saint Kitts and Nevis (kn)') }}</option>
                                <option value="lc">{{ __('Saint Lucia (lc)') }}</option>
                                <option value="mf">{{ __('Saint Martin (French part) (mf)') }}</option>
                                <option value="pm">{{ __('Saint Pierre and Miquelon (pm)') }}</option>
                                <option value="vc">{{ __('Saint Vincent and the Grenadines (vc)') }}</option>
                                <option value="ws">{{ __('Samoa (ws)') }}</option>
                                <option value="sm">{{ __('San Marino (sm)') }}</option>
                                <option value="st">{{ __('Sao Tome and Principe (st)') }}</option>
                                <option value="sa">{{ __('Saudi Arabia (sa)') }}</option>
                                <option value="sn">{{ __('Senegal (sn)') }}</option>
                                <option value="rs">{{ __('Serbia (rs)') }}</option>
                                <option value="sc">{{ __('Seychelles (sc)') }}</option>
                                <option value="sl">{{ __('Sierra Leone (sl)') }}</option>
                                <option value="sg">{{ __('Singapore (sg)') }}</option>
                                <option value="sx">{{ __('Sint Maarten (Dutch part) (sx)') }}</option>
                                <option value="sk">{{ __('Slovakia (sk)') }}</option>
                                <option value="si">{{ __('Slovenia (si)') }}</option>
                                <option value="sb">{{ __('Solomon Islands (sb)') }}</option>
                                <option value="so">{{ __('Somalia (so)') }}</option>
                                <option value="za">{{ __('South Africa (za)') }}</option>
                                <option value="gs">{{ __('South Georgia and the South Sandwich Islands (gs)') }}</option>
                                <option value="ss">{{ __('South Sudan (ss)') }}</option>
                                <option value="es">{{ __('Spain (es)') }}</option>
                                <option value="lk">{{ __('Sri Lanka (lk)') }}</option>
                                <option value="sd">{{ __('Sudan (sd)') }}</option>
                                <option value="sr">{{ __('Suriname (sr)') }}</option>
                                <option value="sj">{{ __('Svalbard and Jan Mayen (sj)') }}</option>
                                <option value="sz">{{ __('Swaziland (sz)') }}</option>
                                <option value="se">{{ __('Sweden (se)') }}</option>
                                <option value="ch">{{ __('Switzerland (ch)') }}</option>
                                <option value="sy">{{ __('Syrian Arab Republic (sy)') }}</option>
                                <option value="tw">{{ __('Taiwan, Province of China (tw)') }}</option>
                                <option value="tj">{{ __('Tajikistan (tj)') }}</option>
                                <option value="tz">{{ __('Tanzania, United Republic of (tz)') }}</option>
                                <option value="th">{{ __('Thailand (th)') }}</option>
                                <option value="tl">{{ __('Timor-Leste (tl)') }}</option>
                                <option value="tg">{{ __('Togo (tg)') }}</option>
                                <option value="tk">{{ __('Tokelau (tk)') }}</option>
                                <option value="to">{{ __('Tonga (to)') }}</option>
                                <option value="tt">{{ __('Trinidad and Tobago (tt)') }}</option>
                                <option value="tn">{{ __('Tunisia (tn)') }}</option>
                                <option value="tr">{{ __('Turkey (tr)') }}</option>
                                <option value="tm">{{ __('Turkmenistan (tm)') }}</option>
                                <option value="tc">{{ __('Turks and Caicos Islands (tc)') }}</option>
                                <option value="tv">{{ __('Tuvalu (tv)') }}</option>
                                <option value="ug">{{ __('Uganda (ug)') }}</option>
                                <option value="ua">{{ __('Ukraine (ua)') }}</option>
                                <option value="ae">{{ __('United Arab Emirates (ae)') }}</option>
                                <option value="gb">{{ __('United Kingdom (gb)') }}</option>
                                <option value="um">{{ __('United States Minor Outlying Islands (um)') }}</option>
                                <option value="uy">{{ __('Uruguay (uy)') }}</option>
                                <option value="uz">{{ __('Uzbekistan (uz)') }}</option>
                                <option value="vu">{{ __('Vanuatu (vu)') }}</option>
                                <option value="ve">{{ __('Venezuela, Bolivarian Republic of (ve)') }}</option>
                                <option value="vn">{{ __('Viet Nam (vn)') }}</option>
                                <option value="vg">{{ __('Virgin Islands, British (vg)') }}</option>
                                <option value="vi">{{ __('Virgin Islands, U.S. (vi)') }}</option>
                                <option value="wf">{{ __('Wallis and Futuna (wf)') }}</option>
                                <option value="eh">{{ __('Western Sahara (eh)') }}</option>
                                <option value="ye">{{ __('Yemen (ye)') }}</option>
                                <option value="zm">{{ __('Zambia (zm)') }}</option>
                                <option value="zw">{{ __('Zimbabwe (zw)') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
                  <x-public.recaptcha />
                @endif

                <div class="form-group text-center mb-0">
                    <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onYoutubeTitleGenerator">
                                <x-loading />
                            </div>
                            <span wire:target="onYoutubeTitleGenerator">{{ __('Generate') }}</span>
                        </span>
                    </button>

                    <button class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" wire:click.prevent="onSample" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onSample">
                                <x-loading />
                            </div>
                            <span wire:target="onSample">{{ __('Sample') }}</span>
                        </span>
                    </button>

                    <button class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onReset" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onReset">
                                <x-loading />
                            </div>
                            <span wire:target="onReset">{{ __('Reset') }}</span>
                        </span>
                    </button>
                </div>
            </div>

            @if ( !empty($temp_data) )
                <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                    <div class="form-group mb-0 text-center">
                        <label class="form-label text-white">{{ __('Click on a title you like if you want to temporarily store it in the box below.') }}</label>
                        <div class="form-selectgroup">
                            @foreach ($temp_data as $value)
                                <label class="form-selectgroup-item" wire:click.prevent="onSetInList('{{ $value }}')">
                                    <input type="checkbox" name="name" value="{{ $value }}" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label">{{ $value }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
            @endif

            @if ( !empty($data) )
                <fieldset class="form-fieldset bg-gradient-secondary rounded p-3 mt-3">
                    <div class="form-group">
                      <label class="form-label text-white">{{ __('Your title list') }}</label>
                      <textarea id="text" class="form-control" rows="6">@php

                            $count = 0;

                            $countData = count($data);

                            foreach ($data as $value) {
                                
                                $count++;

                                if ($count < $countData) 
                                {
                                    $value .= PHP_EOL;
                                }

                                echo $value;
                            }

                        @endphp</textarea>
                    </div>

                    <div class="form-group text-center mb-0">
                        <a class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" value="copy" onclick="copyToClipboard()">{{ __('Copy selected tags') }}</a>
                        <a class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onClearInList">{{ __('Clear selected tags') }}</a>
                    </div>
                </fieldset>
            @endif

      </form>

      <script>
          function copyToClipboard() {
            document.getElementById("text").select();
            document.execCommand('copy');
          }
      </script>

      <script>
        (function( $ ) {
          "use strict";

          document.addEventListener('livewire:load', function () {

              var el      = document.getElementById('paste');
              var input   = document.getElementById('input');
              var tooltip = new bootstrap.Tooltip(el);

              var pasteIcon = '<i class="far fa-clipboard fa-fw"></i>';
              var clearIcon = '<i class="fas fa-trash fa-fw"></i>';

              function setPasteIcon() {
                el.innerHTML = pasteIcon;
                tooltip.dispose();
                el.setAttribute('title', '{{ __('Paste') }}');
                el.classList.remove('text-danger');
                tooltip = new bootstrap.Tooltip(el);
              }

              function setClearIcon() {
                el.innerHTML = clearIcon;
                tooltip.dispose();
                el.setAttribute('title', '{{ __('Clear') }}');
                el.classList.add('text-danger');
                tooltip = new bootstrap.Tooltip(el);
              }

              function checkInputValue() {
                if (input.value) {
                  setClearIcon();
                } else {
                  setPasteIcon();
                }
              }

              checkInputValue(); // Initial check in case there's a value already

              // Handle click on the icon
              el.addEventListener('click', function() {
                if (el.innerHTML === clearIcon) {
                  // Clear action
                  @this.set('query', ''); // Update Livewire state
                  setPasteIcon();
                } else {
                  // Paste action
                  navigator.clipboard.readText().then(function(clipText) {
                    @this.set('query', clipText);
                    setClearIcon();
                  }).catch(function() {
                    // Handle error if needed
                  });
                }
              });

              // Handle changes to the input field
              input.addEventListener('input', checkInputValue);

          });

        })( jQuery );
      </script>
</div>