<div>

      <form wire:submit.prevent="onRobotsTxtGenerator">

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
                        <label class="form-label col-form-label">{{ __('Default - All Robots are') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select wire:model.defer="all_robots" class="form-control">
                            <option value=" ">{{ __('Allow') }}</option>
                            <option value=" /">{{ __('Disallow') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Crawl-Delay') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select wire:model.defer="delay" class="form-control form-select">
                            <option value>{{ __('Default - No Delay') }}</option>
                            <option value="5">{{ __('5') }} {{ __('Seconds') }}</option>
                            <option value="10">{{ __('10') }} {{ __('Seconds') }}</option>
                            <option value="20">{{ __('20') }} {{ __('Seconds') }}</option>
                            <option value="60">{{ __('60') }} {{ __('Seconds') }}</option>
                            <option value="120">{{ __('120') }} {{ __('Seconds') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Sitemap') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" wire:model.defer="sitemap" class="form-control mb-2" placeholder="https://www.example.com/sitemap.xml">
                        <p class="small">{{ __('Leave blank if you don\'t have.') }}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Search Robots:') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <table class="table border table-hover">
                            <tbody>
                                <tr>
                                    <td class="align-middle">{{ __('Google') }}</td>
                                    <td>
                                        <select wire:model.defer="google" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Google Image') }}</td>
                                    <td>
                                        <select wire:model.defer="google_image" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Google Mobile') }}</td>
                                    <td>
                                        <select wire:model.defer="google_mobile" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('MSN Search') }}</td>
                                    <td>
                                        <select wire:model.defer="msn_search" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Yahoo') }}</td>
                                    <td>
                                        <select wire:model.defer="yahoo" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Yahoo MM') }}</td>
                                    <td>
                                        <select wire:model.defer="yahoo_mm" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Yahoo Blogs') }}</td>
                                    <td>
                                        <select wire:model.defer="yahoo_blogs" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle">{{ __('Ask/Teoma') }}</td>
                                    <td>
                                        <select wire:model.defer="ask_teoma" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('GigaBlast') }}</td>
                                    <td>
                                        <select wire:model.defer="gigablast" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('DMOZ Checker') }}</td>
                                    <td>
                                        <select wire:model.defer="dmoz_checker" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Nutch') }}</td>
                                    <td>
                                        <select wire:model.defer="nutch" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Alexa/Wayback') }}</td>
                                    <td>
                                        <select wire:model.defer="alexa" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Baidu') }}</td>
                                    <td>
                                        <select wire:model.defer="baidu" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">{{ __('Naver') }}</td>
                                    <td>
                                        <select wire:model.defer="naver" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle">{{ __('MSN PicSearch') }}</td>
                                    <td>
                                        <select wire:model.defer="msb_picpearch" class="form-control form-select">
                                            <option value>{{ __('Same as Default') }}</option>
                                            <option value=" ">{{ __('Allow') }}</option>
                                            <option value=" /">{{ __('Disallow') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label class="form-label col-form-label">{{ __('Disallow Folders') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="small mb-2">{{ __('The path is relative to the root and must contain a trailing slash "/".') }}</p>
                        <div class="col mb-3">
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" wire:model.defer="folders.0" placeholder="/cgi-bin/">
                                @error('folders.0') <span class="error">{{ $message }}</span> @enderror
                                <span class="input-group-text">
                                    <button class="btn btn-sm btn-icon-only bg-success text-white rounded mb-0" wire:click.prevent="onAddFolder()" title="{{ __('Add new') }}">
                                        <i class="fas fa-plus fa-fw "></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        @foreach($inputs as $key => $value)
                            <div class="col mb-3">
                                <div class="input-group input-group-flat">
                                    <input type="text" class="form-control" wire:model.defer="folders.{{ $value }}" placeholder="/cgi-bin/">
                                    @error( 'folders.' . $value ) <span class="error">{{ $message }}</span> @enderror
                                    <span class="input-group-text">
                                        <button class="btn btn-sm btn-icon-only bg-danger text-white rounded mb-0" wire:click.prevent="onDeleteFolder({{ $key }})" title="{{ __('Delete') }}">
                                            <i class="fas fa-trash fa-fw "></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
              <x-public.recaptcha />
            @endif
        
            <div class="form-group mb-0 text-center">
                <button class="btn bg-gradient-info w-100 w-md-auto mb-0" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onRobotsTxtGenerator">
                            <x-loading />
                        </div>
                        <span wire:target="onRobotsTxtGenerator">{{ __('Generate') }}</span>
                    </span>
                </button>
            </div>
        </div>

        @if ( !empty($data) )
            <div class="form-group position-relative mt-3">
              <textarea id="textbox" class="form-control" rows="10" readonly>{{ $data }}</textarea>
              <a onclick="saveTextAsFile('robots.txt')" class="btn bg-gradient-success btn-sm cursor-pointer position-absolute top-0 end-0 m-2">
                  {{ __('Export Robots.txt') }}
              </a>
            </div>
        @endif

      </form>

        <script>
            function saveTextAsFile(fileNameToSaveAs)
            {
                var textbox = document.getElementById('textbox');

                var textFileAsBlob = new Blob([textbox.value], {type:'text/plain'}); 

                var downloadLink = document.createElement("a");

                downloadLink.download = fileNameToSaveAs;

                if (window.webkitURL != null) {
                    // Chrome allows the link to be clicked
                    // without actually adding it to the DOM.
                    downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
                } else {
                    // Firefox requires the link to be added to the DOM
                    // before it can be clicked.
                    downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                }

                downloadLink.click();
            }
        </script>
</div>