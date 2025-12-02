<style>
    /* ===== SIDEBAR ORANGE THEME STYLES ===== */
    :root {
        --orange-primary: #F28705;
        --orange-hover: rgba(242, 135, 5, 0.1);
        --orange-focus: rgba(242, 135, 5, 0.2);
        --orange-dark: #e67e22;
        --submenu-bg: #fff8f0;
        --text-gray: #6c757d;
    }

    /* Base Sidebar Styles */
    #sidebar {
        background: #ffffff !important;
        border-right: 1px solid #e9ecef !important;
        box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1) !important;
    }

    /* Header */
    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--orange-primary) !important;
        padding: 1rem;
        margin-bottom: 0.5rem;
    }

    .sidebar-logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: contain;
        background: white;
        padding: 2px;
    }

    .sidebar-title {
        font-size: 1.6rem;
        color: #ffffff !important;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Menu Container */
    .sidebar-menu {
        padding: 0 0.5rem;
    }

    /* Main Menu Items */
    .sidebar-item {
        margin: 0.25rem 0;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.7rem 1rem;
        border-radius: 6px;
        text-decoration: none !important;
        font-weight: 500;
        transition: all 0.2s ease;
        color: var(--text-gray) !important;
        background: transparent !important;
        font-size: 0.95rem;
    }

    .sidebar-link span {
        color: var(--text-gray) !important;
    }

    .sidebar-link i {
        margin-right: 10px;
        width: 18px;
        color: var(--text-gray) !important;
    }

    /* Hover and Active States */
    .sidebar-item:not(.active) .sidebar-link:hover {
        background: var(--orange-hover) !important;
        color: var(--orange-primary) !important;
    }

    .sidebar-item:not(.active) .sidebar-link:hover span,
    .sidebar-item:not(.active) .sidebar-link:hover i {
        color: var(--orange-primary) !important;
    }

    .sidebar-item.active .sidebar-link {
        background: var(--orange-primary) !important;
        color: #ffffff !important;
    }

    .sidebar-item.active .sidebar-link span,
    .sidebar-item.active .sidebar-link i {
        color: #ffffff !important;
    }

    /* Submenu Styles */
    .submenu {
        background: var(--submenu-bg) !important;
        border-radius: 6px;
        margin: 0.25rem 0 0 0.5rem;
        padding: 0.25rem;
        border-left: 3px solid var(--orange-primary);
    }

    .submenu li {
        margin: 0.1rem 0;
    }

    .submenu a {
        display: block;
        padding: 0.5rem 0.75rem;
        border-radius: 4px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        color: var(--text-gray) !important;
        background: transparent !important;
        font-weight: 400;
        font-size: 0.9rem;
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
    }

    .sidebar-toggler:hover {
        background: var(--orange-dark) !important;
    }

    /* Remove default styles */
    #sidebar ul {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Submenu visibility */
    .has-sub .submenu {
        display: block;
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transform: translateY(-10px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 0;
    }

    .has-sub.active .submenu {
        opacity: 1;
        max-height: 300px;
        transform: translateY(0);
        margin-top: 0.25rem;
    }

    /* JavaScript toggle functionality */
    .sidebar-item.has-sub>.sidebar-link {
        cursor: pointer;
        position: relative;
    }

    .sidebar-item.has-sub>.sidebar-link::after {
        content: '▼';
        position: absolute;
        right: 1rem;
        font-size: 0.8rem;
        color: inherit;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-item.has-sub.active>.sidebar-link::after {
        transform: rotate(180deg);
    }

    /* Enhanced submenu item animations */
    .submenu li {
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
        transition-delay: 0s;
    }

    .has-sub.active .submenu li {
        opacity: 1;
        transform: translateX(0);
    }

    .has-sub.active .submenu li:nth-child(1) {
        transition-delay: 0.1s;
    }

    .has-sub.active .submenu li:nth-child(2) {
        transition-delay: 0.15s;
    }

    .has-sub.active .submenu li:nth-child(3) {
        transition-delay: 0.2s;
    }

    .has-sub.active .submenu li:nth-child(4) {
        transition-delay: 0.25s;
    }

    .has-sub.active .submenu li:nth-child(5) {
        transition-delay: 0.3s;
    }

    .sidebar-wrapper.sidebar-orange .menu .sidebar-item.active .sidebar-link:before {
        background-color: #F28705;
        /* ganti dengan warna yang diinginkan */
        /* jika rule sebelumnya lebih spesifik, tambahkan !important:
        background-color: #fff8f0 !important;
        */
    }

    .sidebar-wrapper.sidebar-orange .sidebar-item:hover>.sidebar-link {
        border-left: 3px solid #F28705;
        /* ganti dengan warna yang diinginkan */
    }

    .sidebar-wrapper.sidebar-orange .sidebar-item.active>.sidebar-link {
        border-left: 3px solid #F28705;
        /* ganti dengan warna yang diinginkan */
    }

    .sidebar-wrapper.sidebar-orange .submenu li:hover>a {
        border-left: 3px solid #F28705;
        /* ganti dengan warna yang diinginkan */
    }
</style>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active sidebar-orange">
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
                @if (auth()->user()->hasRole(['admin', 'super-admin']))
                    <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="sidebar-link">
                            <i data-feather="users"></i>
                            <span>
                                @if (auth()->user()->hasRole('super-admin'))
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle sidebar submenu toggle
        const submenuToggles = document.querySelectorAll('.has-sub > .sidebar-link');

        submenuToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                const parentItem = this.parentElement;
                const isActive = parentItem.classList.contains('active');

                // Close all other submenus with animation
                document.querySelectorAll('.has-sub').forEach(function(item) {
                    if (item !== parentItem && item.classList.contains('active')) {
                        // Reset submenu items animation
                        const submenuItems = item.querySelectorAll('.submenu li');
                        submenuItems.forEach(function(item, index) {
                            item.style.transitionDelay = '0s';
                        });
                        item.classList.remove('active');
                    }
                });

                // Toggle current submenu with staggered animation
                if (isActive) {
                    // Closing animation - reset delays
                    const submenuItems = parentItem.querySelectorAll('.submenu li');
                    submenuItems.forEach(function(item) {
                        item.style.transitionDelay = '0s';
                    });
                    parentItem.classList.remove('active');
                } else {
                    // Opening animation - staggered delays
                    parentItem.classList.add('active');
                    const submenuItems = parentItem.querySelectorAll('.submenu li');
                    submenuItems.forEach(function(item, index) {
                        item.style.transitionDelay = (0.1 + index * 0.05) + 's';
                    });
                }
            });
        });

        // Add hover effects for enhanced interaction
        document.querySelectorAll('.sidebar-item.has-sub').forEach(function(item) {
            const link = item.querySelector('.sidebar-link');

            link.addEventListener('mouseenter', function() {
                if (!item.classList.contains('active')) {
                    this.style.transform = 'translateX(3px)';
                }
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
