<style>
/* ===== SIDEBAR ORANGE THEME STYLES ===== */
:root {
    --orange-primary: #F28705;
    --orange-hover: rgba(242, 135, 5, 0.1);
    --orange-focus: rgba(242, 135, 5, 0.3);
    --orange-dark: #e67e22;
    --submenu-bg: #fff8f0;
    --text-gray: #666;
}

/* Base Sidebar Styles */
#sidebar {
    background: transparent !important;
}

#sidebar * {
    box-sizing: border-box;
}

#sidebar ul {
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Header */
.sidebar-header {
    display: flex;
    align-items: center;
    background: var(--orange-primary) !important;
    padding: 1rem;
    margin-bottom: 0.5rem;
    border-radius: 0px;
}

.sidebar-logo {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    margin-right: 12px;
    object-fit: contain;
    background: rgba(255, 255, 255, 0.1);
    padding: 2px;
}

.sidebar-title {
    font-size: 1.6rem;
    color: #ffffff !important;
    font-weight: 800;
    letter-spacing: 3px;
    text-shadow: none !important;
}

/* Menu Container */
.sidebar-menu {
    padding: 0.5rem;
    background: transparent !important;
}

/* Main Menu Items */
.sidebar-item {
    margin: 0.25rem 0;
}

.sidebar-link {
    display: flex;
    align-items: center;
    padding: 0.6rem 1rem;
    margin: 0.25rem;
    border-radius: 6px;
    text-decoration: none !important;
    font-weight: 500;
    transition: all 0.2s ease;
    color: var(--orange-primary) !important;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

.sidebar-link:hover,
.sidebar-link:focus {
    text-decoration: none !important;
}

.sidebar-link i {
    margin-right: 0.5rem;
    width: 18px;
    stroke: currentColor !important;
}

/* Active States */
.sidebar-item.active .sidebar-link {
    background: var(--orange-primary) !important;
    color: #ffffff !important;
}

.sidebar-item:not(.active) .sidebar-link:hover {
    background: var(--orange-hover) !important;
    color: var(--orange-primary) !important;
}

.sidebar-link:focus {
    box-shadow: 0 0 0 2px var(--orange-focus) !important;
    border-color: var(--orange-primary) !important;
}

/* Submenu Styles */
.submenu {
    background: var(--submenu-bg);
    border-radius: 6px;
    margin: 0.25rem 0.5rem;
    padding: 0.25rem;
    overflow: hidden;
}

.submenu li {
    margin: 0.15rem;
}

.submenu a {
    display: block;
    padding: 0.4rem 0.75rem;
    border-radius: 4px;
    text-decoration: none !important;
    transition: all 0.2s ease;
    color: var(--text-gray) !important;
    background: transparent !important;
    font-weight: 400;
}

.submenu li.active a {
    color: var(--orange-primary) !important;
    background: #ffffff !important;
    font-weight: 600;
}

.submenu li:not(.active) a:hover {
    background: #ffffff !important;
    color: var(--orange-primary) !important;
}

/* Toggle Button */
.sidebar-toggler {
    background: var(--orange-primary) !important;
    border: none !important;
    color: #ffffff !important;
    border-radius: 6px;
    padding: 0.5rem;
    margin: 0.5rem;
    transition: all 0.2s ease;
}

.sidebar-toggler:hover {
    background: var(--orange-dark) !important;
}

/* Selection Prevention */
#sidebar *::-moz-selection {
    background: var(--orange-focus) !important;
}

#sidebar *::selection {
    background: var(--orange-focus) !important;
}

/* Focus States */
#sidebar a:focus {
    outline: none !important;
    box-shadow: 0 0 0 2px var(--orange-focus) !important;
}
</style>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Header -->
        <div class="sidebar-header">
            <img src="{{ asset('frontend/dist/assets/images/avatar/unslogo.png') }}" alt="Logo" class="sidebar-logo">
            <span class="sidebar-title">JITUPASNA</span>
        </div>

        <!-- Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <!-- Dashboard -->
                <li class="sidebar-item {{ Request::is('/') || Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="sidebar-link">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Kategori -->
                <li class="sidebar-item has-sub {{ Request::is('kategori-*') || Request::is('satuan*') || Request::is('hsd*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i data-feather="layers"></i>
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

                <!-- Jitupasna -->
                <li class="sidebar-item has-sub {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i data-feather="triangle"></i>
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

                <!-- User Management -->
                @if(auth()->user()->hasRole(['admin', 'super-admin']))
                <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="sidebar-link">
                        <i data-feather="users"></i>
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

        <!-- Toggle Button -->
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
