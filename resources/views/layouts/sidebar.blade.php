<div id="sidebar" class='active' style="transition: none !important;">
    <div class="sidebar-wrapper active" style="transition: none !important;">
        <div class="sidebar-header" style="display: flex; align-items: center; transition: none !important;">
            <img src="{{ asset('frontend/dist/assets/images/avatar/unslogo.png') }}" alt="" srcset=""
                style="margin-right: 10px;">
            <span style="font-size:smaller;">JITUPASNA</span>
        </div>
        <div class="sidebar-menu" style="transition: none !important;">
            <ul class="menu" style="transition: none !important;">
                {{-- <li class='sidebar-title'>Main Menu</li> --}}
                <li class="sidebar-item {{ Request::is('/') || Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" style="transition: none !important;">
                    <a href="{{ url('/') }}" class='sidebar-link' style="transition: none !important;">
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('kategori-*') || Request::is('satuan*') || Request::is('hsd*') ? 'active' : '' }}" style="transition: none !important;">
                    <a href="#" class='sidebar-link' style="transition: none !important;">
                        <i data-feather="layers" width="20"></i>
                        <span>Kategori</span>
                    </a>
                    <ul class="submenu {{ Request::is('kategori-*') || Request::is('satuan*') || Request::is('hsd*') ? 'active' : '' }}" style="transition: none !important;">
                        <li class="{{ Request::is('kategori-bangunan*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('kategori-bangunan.index') }}" style="transition: none !important;">Bangunan</a>
                        </li>
                        <li class="{{ Request::is('kategori-bencana*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('kategori-bencana.index') }}" style="transition: none !important;">Bencana</a>
                        </li>
                        <li class="{{ Request::is('satuan*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('satuan.index') }}" style="transition: none !important;">Satuan</a>
                        </li>
                        <li class="{{ Request::is('hsd*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('hsd.index') }}" style="transition: none !important;">Harga Satuan Dasar</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}" style="transition: none !important;">
                    <a href="#" class='sidebar-link' style="transition: none !important;">
                        <i data-feather="triangle" width="20"></i>
                        <span>Jitupasna</span>
                    </a>
                    <ul class="submenu {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}" style="transition: none !important;">
                        <li class="{{ Request::is('bencana*') && !Request::query('source') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('bencana.index') }}" style="transition: none !important;">Bencana</a>
                        </li>
                        <li class="{{ Request::is('kerusakan*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('kerusakan.list') }}" style="transition: none !important;">Kerusakan</a>
                        </li>
                        <li class="{{ Request::is('kerugian*') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('kerugian.list') }}" style="transition: none !important;">Kerugian</a>
                        </li>
                        <li class="{{ Request::is('kebutuhan*') || (Request::is('bencana*') && Request::query('source') == 'kebutuhan') ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('bencana.index', ['source' => 'kebutuhan']) }}" style="transition: none !important;">Kebutuhan</a>
                        </li>
                        <li class="{{ Request::is('bencana*') && Request::query('source') == 'forms' ? 'active' : '' }}" style="transition: none !important;">
                            <a href="{{ route('bencana.index', ['source' => 'forms']) }}" style="transition: none !important;">Formulir</a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->hasRole(['admin', 'super-admin']))
                <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}" style="transition: none !important;">
                    <a href="{{ route('users.index') }}" class='sidebar-link' style="transition: none !important;">
                        <i data-feather="users" width="20"></i>
                        <span style="transition: none !important;">
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
        <button class="sidebar-toggler btn x" style="transition: none !important;"><i data-feather="x"></i></button>
    </div>
</div>