<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        @foreach ($menus as $menu)
            @if ($menu['hasSub'])
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>{{ $menu['name'] }}</span>
                    </a>
                    @foreach ($menu['subMenu'] as $m)
                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="{{ $m['url'] }}" class="submenu-link">{{ $m['name'] }}</a>
                            </li>
                        </ul>
                    @endforeach
                </li>
            @else
                <li class="sidebar-item {{ request()->is('*/dashboard') ? 'active' : '' }} ">
                    <a href="{{ $menu['url'] }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ $menu['name'] }}</span>
                    </a>
                </li>
            @endif
        @endforeach
        <li class="sidebar-item" style="position:absolute; bottom:10px; width:80%">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-block btn-danger icon icon-left" type="submit">
                    <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-alert-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
