<div class="collapse navbar-collapse mt-2" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
    <ul class="navbar-nav justify-content-end">

        <li class="nav-item d-xl-none me-2">
          <a class="btn btn-icon btn-icon-only mb-0 bg-white d-flex align-items-center" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>

        <div class="nav-item me-2">
            <a class="btn btn-icon btn-icon-only mb-0 bg-white btn-toggle-mode" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Theme Mode (Light / Dark)') }}">
                @if ( empty(Cookie::get('theme_mode')) || Cookie::get('theme_mode') === 'theme-light' )
                    <i class="fas fa-moon text-warning"></i>
                @else
                    <i class="fas fa-sun text-warning"></i>
                @endif
            </a>
        </div>

        <div class="nav-item dropdown d-md-flex px-3">
            <a class="nav-link px-0 cursor-pointer text-body" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
                <span class="badge bg-red"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end px-2 mt-4 text-center">
                {{ __('Version') }}: <span class="badge bg-success">{{ Config::get('app.version') }}</span>
            </div>
        </div>

        <li class="nav-item dropdown">
            <a class="nav-link text-body" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 mt-4" aria-labelledby="dropdownMenuUser">
                <li>
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item border-radius-md">
                        <i class="fas fa-user fa-fw me-2"></i>
                        {{ __('Profile') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item border-radius-md">
                        <i class="fas fa-power-off fa-fw me-2"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
