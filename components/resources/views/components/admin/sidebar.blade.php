<aside class="sidenav {{ ( Cookie::get('theme_mode') == 'theme-dark') ? '' : 'bg-white' }} navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps" id="sidenav-main">
   
    <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('home') }}">
                @if ( Cookie::get('theme_mode') === 'theme-dark' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_dark }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @elseif( Cookie::get('theme_mode') === 'theme-light' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @else
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @endif
            </a>
        </div>
        <hr class="horizontal dark mt-0">

        <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.dashboard.index') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.posts.index', 'admin.posts.translations.index', 'admin.posts.translations.create', 'admin.posts.translations.edit') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-pencil-alt text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Posts') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.pages.index', 'admin.pages.translations.index', 'admin.pages.translations.create', 'admin.pages.translations.edit', 'admin.pages.authentication.index') ? 'active' : '' }}" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Pages') }}</span>
                    </a>

                    <div id="pages" class="multi-collapse collapse {{ Route::is('admin.pages.index', 'admin.pages.translations.index', 'admin.pages.translations.create', 'admin.pages.translations.edit', 'admin.pages.authentication.index') ? 'show' : '' }}">

                      <ul class="nav ms-4">
                          <li class="nav-item {{ Route::is('admin.pages.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.pages.index') }}">
                                {{ __('All Pages') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('admin.pages.authentication.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.pages.authentication.index') }}">
                                {{ __('Authentication') }}
                            </a>
                          </li>
                      </ul>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is( 'admin.tools.index', 'admin.tools.categories.index') ? 'show' : '' }} {{ Route::is( 'admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit', 'admin.tools.categories.index', 'admin.tools.history.index') ? 'active' : '' }}" data-bs-toggle="collapse" href="#tools" role="button" aria-expanded="false" aria-controls="tools">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-settings text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Tools') }}</span>
                    </a>

                    <div id="tools" class="multi-collapse collapse {{ Route::is( 'admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit', 'admin.tools.categories.index', 'admin.tools.history.index') ? 'show' : '' }}">

                      <ul class="nav ms-4">
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit') ? 'active' : '' }}" href="{{ route('admin.tools.index') }}">
                                {{ __('All Tools') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.tools.categories.index') ? 'active' : '' }}" href="{{ route('admin.tools.categories.index') }}">
                                {{ __('Categories') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.tools.history.index') ? 'active' : '' }}" href="{{ route('admin.tools.history.index') }}">
                                {{ __('History') }}
                            </a>
                          </li>
                      </ul>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.general.index', 'admin.menus.index', 'admin.header.index', 'admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit', 'admin.apikeys.index', 'admin.proxy.index', 'admin.captcha.index', 'admin.sociallogin.index', 'admin.sidebars.index', 'admin.gdpr.index', 'admin.advertisements.index', 'admin.smtp.index', 'admin.languages.index', 'admin.languages.translations.edit', 'admin.redirects.index', 'admin.advanced.index') ? 'active' : '' }}" data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-cogs text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Settings') }}</span>
                    </a>

                    <div id="theme-settings" class="multi-collapse collapse {{ Route::is('admin.general.index', 'admin.menus.index', 'admin.header.index', 'admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit', 'admin.apikeys.index', 'admin.proxy.index', 'admin.captcha.index', 'admin.sociallogin.index', 'admin.sidebars.index', 'admin.gdpr.index', 'admin.advertisements.index', 'admin.smtp.index', 'admin.languages.index', 'admin.languages.translations.edit', 'admin.redirects.index', 'admin.advanced.index') ? 'show' : '' }}">
                        <ul class="nav ms-4">
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.general.index') ? 'active' : '' }}" href="{{ route('admin.general.index') }}">
                                {{ __('General') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.header.index') ? 'active' : '' }}" href="{{ route('admin.header.index') }}">
                                {{ __('Header') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit') ? 'active' : '' }}" href="{{ route('admin.footer.index') }}">
                                {{ __('Footer') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.menus.index') ? 'active' : '' }}" href="{{ route('admin.menus.index') }}">
                                {{ __('Menus') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.sidebars.index') ? 'active' : '' }}" href="{{ route('admin.sidebars.index') }}">
                                {{ __('Sidebars') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.gdpr.index') ? 'active' : '' }}" href="{{ route('admin.gdpr.index') }}">
                                {{ __('GDPR Cookies') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.advertisements.index') ? 'active' : '' }}" href="{{ route('admin.advertisements.index') }}">
                                {{ __('Advertisements') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.smtp.index') ? 'active' : '' }}" href="{{ route('admin.smtp.index') }}">
                                {{ __('SMTP') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.apikeys.index') ? 'active' : '' }}" href="{{ route('admin.apikeys.index') }}">
                                {{ __('API Keys') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                             <a class="nav-link {{ Route::is('admin.proxy.index') ? 'active' : '' }}" href="{{ route('admin.proxy.index') }}">
                                {{ __('Proxy') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.captcha.index') ? 'active' : '' }}" href="{{ route('admin.captcha.index') }}">
                                {{ __('Captcha') }}
                            </a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.sociallogin.index') ? 'active' : '' }}" href="{{ route('admin.sociallogin.index') }}">
                                {{ __('Social Login') }}
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link {{ ( Route::is('admin.redirects.index') ) ? 'active' : '' }}" href="{{ route('admin.redirects.index') }}">
                                {{ __('Redirects') }}
                            </a>
                          </li>

                           <li class="nav-item">
                            <a class="nav-link {{ ( Route::is('admin.languages.index') || Route::is('admin.languages.translations.edit') ) ? 'active' : '' }}" href="{{ route('admin.languages.index') }}">
                                {{ __('Languages') }}
                            </a>
                          </li>

                           <li class="nav-item">
                            <a class="nav-link {{ ( Route::is('admin.advanced.index') ) ? 'active' : '' }}" href="{{ route('admin.advanced.index') }}">
                                {{ __('Advanced') }}
                            </a>
                          </li>
                        </ul>
                    </div>
                </li>

               <li class="nav-item {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'show' : '' }}" data-bs-toggle="collapse" href="#indexing" role="button" aria-expanded="false" aria-controls="indexing">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-clock text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Instant Indexing') }}</span>
                    </a>

                    <div id="indexing" class="multi-collapse collapse {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'show' : '' }}">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.indexing.submit') ? 'active' : '' }}" href="{{ route('admin.indexing.submit') }}">
                                    {{ __('Submit') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.indexing.history') ? 'active' : '' }}" href="{{ route('admin.indexing.history') }}">
                                    {{ __('History') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Users') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.report.index') ? 'active' : '' }}" href="{{ route('admin.report.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-link text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Report') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.cache.index') ? 'active' : '' }}" href="{{ route('admin.cache.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-archive text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Cache') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.sitemap.index') ? 'active' : '' }}" href="{{ route('admin.sitemap.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-sitemap text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Sitemap') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  {{ Route::is('admin.license.index') ? 'active' : '' }}" href="{{ route('admin.license.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-key text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('License') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.about.index') ? 'active' : '' }}" href="{{ route('admin.about.index') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-info text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('About') }}</span>
                    </a>
                </li>

            </ul>

        </div>

</aside>
