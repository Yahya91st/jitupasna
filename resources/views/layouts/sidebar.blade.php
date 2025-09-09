<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="display: flex; align-items: center;">
            <img src="{{ asset('frontend/dist/assets/images/avatar/unslogo.png') }}" alt="" srcset=""
                style="margin-right: 10px;">
            <span style="font-size:smaller;">JITUPASNA</span>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                {{-- <li class='sidebar-title'>Main Menu</li> --}}
                <li class="sidebar-item {{ Request::is('/') || Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('kategori-*') || Request::is('satuan*') || Request::is('hsd*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i>
                        <span>Kategori</span>
                    </a>
                    <ul class="submenu {{ Request::is('kategori-*') || Request::is('satuan*') || Request::is('hsd*') ? 'active' : '' }}">
                        <li class="{{ Request::is('kategori-bangunan*') ? 'active' : '' }}">
                            <a href="{{ route('kategori-bangunan.index') }}">Bangunan</a>
                        </li>
                        <li class="{{ Request::is('kategori-bencana*') ? 'active' : '' }}">
                            <a href="{{ route('kategori-bencana.index') }}">Bencana</a>
                        </li>
                        <li class="{{ Request::is('satuan*') ? 'active' : '' }}">
                            <a href="{{ route('satuan.index') }}">Satuan</a>
                        </li>
                        <li class="{{ Request::is('hsd*') ? 'active' : '' }}">
                            <a href="{{ route('hsd.index') }}">Harga Satuan Dasar</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Jitupasna</span>
                    </a>
                    <ul class="submenu {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}">
                        <li class="{{ Request::is('bencana*') && !Request::query('source') ? 'active' : '' }}">
                            <a href="{{ route('bencana.index') }}">Bencana</a>
                        </li>
                        <li class="{{ Request::is('kerusakan*') ? 'active' : '' }}">
                            <a href="{{ route('kerusakan.list') }}">Kerusakan</a>
                        </li>
                        <li class="{{ Request::is('kerugian*') ? 'active' : '' }}">
                            <a href="{{ route('kerugian.list') }}">Kerugian</a>
                        </li>
                        <li class="{{ Request::is('kebutuhan*') || (Request::is('bencana*') && Request::query('source') == 'kebutuhan') ? 'active' : '' }}">
                            <a href="{{ route('bencana.index', ['source' => 'kebutuhan']) }}">Kebutuhan</a>
                        </li>
                        <li class="{{ Request::is('bencana*') && Request::query('source') == 'forms' ? 'active' : '' }}">
                            <a href="{{ route('bencana.index', ['source' => 'forms']) }}">Formulir</a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->hasRole(['admin', 'super-admin']))
                <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>
                            @if(auth()->user()->hasRole('super-admin'))
                                Manajemen Admin
                            @else
                                Manajemen Pengguna
                            @endif
                        </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
