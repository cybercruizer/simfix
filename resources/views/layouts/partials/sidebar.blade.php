<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
            <li class="sidebar-item {{ request()->is($prefix.'/dashboard') ? 'active' : '' }}">
                <a href="{{ '/'.$prefix.'/'.'dashboard' }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @foreach ($menus['menus']->whereNull('parent_id') as $menu)
            <li class="sidebar-item {{ count($menu->children) ? 'has-sub':'' }}  {{ request()->is($prefix.'/'.$menu->url) ? 'active' : '' }}">
                <a href="{{ '/'.$prefix.'/'.$menu->url }}" class='sidebar-link'>
                    <i class="{{ $menu->icon ?? ''}}"></i>
                    <span>{{ ($menu->nama) }}</span>
                </a>
                @if(count($menu->children))
                    <ul class="submenu ">
                        @foreach($menu->children as $child)
                            <li class="submenu-item">
                                <a href="{{ '/'.$prefix.'/'.$child->url }}" class="submenu-link">{{ $child->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        <li class="sidebar-item my-4" style="position:relative; bottom:10px; width:90%">
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
