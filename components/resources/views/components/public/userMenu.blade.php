<div class="nav-item dropdown">
  <div class="author align-items-center cursor-pointer" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
      <img {{ ($general->lazy_loading == true) ? 'data-' : '' }}src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=150&d=mm&r=g" alt="{{ __('Avatar') }}" class="avatar shadow {{ ($general->lazy_loading == true) ? 'lazyload' : '' }}">
      <div class="name d-none d-xl-block ps-2">
          <span>{{ $user->fullname }}</span>
          <div class="stats">
              <small>{{ ( $user->is_admin == 1) ? __('Administrator') : __('Member') }}</small>
          </div>
      </div>
  </div>

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user" aria-labelledby="dropdownMenuUser">
        @if ( $user->is_admin == 1 )
            <li>
                <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item border-radius-md">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>
                    {{ __('Admin Dashboard') }}
                </a>
            </li>
        @endif

        @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status )
            <li>
                <a href="{{ route('user.profile') }}" class="dropdown-item border-radius-md">
                    <i class="fas fa-user fa-fw me-2"></i>
                    {{ __('Profile') }}
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('user.logout') }}" class="dropdown-item border-radius-md">
                <i class="fas fa-power-off fa-fw me-2"></i>
                {{ __('Logout') }}
            </a>
        </li>
  </ul>
</div>