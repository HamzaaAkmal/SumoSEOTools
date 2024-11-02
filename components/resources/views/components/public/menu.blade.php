<div class="dropdown-menu px-2 mt-0 mt-lg-4">
        <ul class="list-group py-3 py-lg-0">

         @foreach($childs as $key => $child)

            @if(count($child['children']))

                <li class="nav-item dropdown dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md" href="#navbarDropdownMenuChild{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <div class="d-flex">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                                <p class="dropdown-header d-flex align-items-center p-0">
                                   @if ( !empty($child['icon']) )
                                     <i class="{{ $child['icon'] }} me-2"></i>
                                   @endif
                                    {{ __($child['text']) }}
                                </p>
                                <img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow ms-1" />
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu mt-lg-0 p-2">
                        @foreach ($child['children'] as $key => $value)
                            <a class="dropdown-item ps-3 border-radius-md" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} me-2"></i>
                               @endif
                                {{ __($value['text']) }}
                            </a>
                        @endforeach
                    </div>
                </li>

            @else
                <li class="nav-item dropdown dropdown-subitem list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md" href="{{ ( $child['menu_items']  == 'custom' ) ? $child['url'] : route('home') . '/' . $child['url'] }}">
                        <div class="d-flex">
                            <div class="w-100 d-flex align-items-center justify-content-between">
                                <p class="dropdown-header d-flex align-items-center p-0">
                                   @if ( !empty($child['icon']) )
                                     <i class="{{ $child['icon'] }} me-2"></i>
                                   @endif
                                    {{ __($child['text']) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            @endif

         @endforeach

        </ul>
</div>