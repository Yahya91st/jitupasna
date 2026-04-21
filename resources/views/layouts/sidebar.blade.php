<style>
    /* ===== PROFESSIONAL SIDEBAR WITH SMOOTH ANIMATIONS ===== */
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        --orange-light: rgba(242, 135, 5, 0.08);
        --orange-medium: rgba(242, 135, 5, 0.15);
        --submenu-bg: #fafafa;
        --text-primary: #2c3e50;
        --text-secondary: #6c757d;
        --white: #ffffff;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Base Sidebar */
    #sidebar {
        background: var(--white) !important;
        border-right: 1px solid #e9ecef !important;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08) !important;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* Header with Gradient */
    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--orange-gradient) !important;
        padding: 1.25rem 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.2);
        position: relative;
        overflow: hidden;
    }

    .sidebar-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
    }

    .sidebar-logo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: contain;
        background: var(--white);
        padding: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        transition: var(--transition);
    }

    .sidebar-logo:hover {
        transform: scale(1.05) rotate(5deg);
    }

    .sidebar-title {
        font-size: 1.5rem;
        color: var(--white) !important;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Menu Container */
    .sidebar-menu {
        padding: 0 0.75rem;
    }

    /* Menu Items */
    .sidebar-item {
        margin: 0.4rem 0;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        text-decoration: none !important;
        font-weight: 500;
        transition: var(--transition);
        color: var(--text-secondary) !important;
        background: transparent !important;
        font-size: 0.95rem;
        position: relative;
        overflow: hidden;
    }

    .sidebar-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;
        background: var(--orange-gradient);
        transition: width 0.3s ease;
        border-radius: 8px 0 0 8px;
    }

    .sidebar-link span {
        color: var(--text-secondary) !important;
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    .sidebar-link i {
        margin-right: 12px;
        width: 20px;
        height: 20px;
        color: var(--text-secondary) !important;
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    /* Hover States */
    .sidebar-item:not(.active):not(.has-sub) .sidebar-link:hover {
        background: var(--orange-light) !important;
        transform: translateX(4px);
    }

    .sidebar-item:not(.active):not(.has-sub) .sidebar-link:hover::before {
        width: 3px;
    }

    .sidebar-item:not(.active):not(.has-sub) .sidebar-link:hover span,
    .sidebar-item:not(.active):not(.has-sub) .sidebar-link:hover i {
        color: var(--orange-primary) !important;
    }

    .sidebar-item:not(.active):not(.has-sub) .sidebar-link:hover i {
        transform: scale(1.1);
    }

    /* Active States */
    .sidebar-item.active:not(.has-sub) .sidebar-link {
        background: var(--orange-gradient) !important;
        color: var(--white) !important;
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
    }

    .sidebar-item.active:not(.has-sub) .sidebar-link span,
    .sidebar-item.active:not(.has-sub) .sidebar-link i {
        color: var(--white) !important;
    }

    /* Has-sub Parent */
    .sidebar-item.has-sub .sidebar-link {
        font-weight: 600;
        cursor: pointer;
    }

    .sidebar-item.has-sub:not(.active) .sidebar-link:hover {
        background: var(--orange-light) !important;
        transform: translateX(4px);
    }

    .sidebar-item.has-sub:not(.active) .sidebar-link:hover::before {
        width: 3px;
    }

    .sidebar-item.has-sub:not(.active) .sidebar-link:hover span,
    .sidebar-item.has-sub:not(.active) .sidebar-link:hover i {
        color: var(--orange-primary) !important;
    }

    .sidebar-item.has-sub.active > .sidebar-link {
        background: var(--orange-medium) !important;
        color: var(--orange-primary) !important;
    }

    .sidebar-item.has-sub.active > .sidebar-link span,
    .sidebar-item.has-sub.active > .sidebar-link i {
        color: var(--orange-primary) !important;
    }

    /* Toggle Arrow */
    .sidebar-item.has-sub > .sidebar-link::after {
        content: '▼';
        position: absolute;
        right: 1rem;
        font-size: 0.7rem;
        color: inherit;
        transition: transform 0.3s ease;
        opacity: 0.7;
        z-index: 1;
    }

    .sidebar-item.has-sub > .sidebar-link:hover::after {
        opacity: 1;
    }

    .sidebar-item.has-sub.active > .sidebar-link::after {
        transform: rotate(180deg);
    }

    /* Submenu */
    .submenu {
        background: var(--submenu-bg) !important;
        border-radius: 8px;
        margin: 0.5rem 0 0.5rem 1rem;
        padding: 0.5rem;
        border-left: 3px solid var(--orange-primary);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .submenu li {
        margin: 0.25rem 0;
    }

    .submenu a {
        display: flex;
        align-items: center;
        padding: 0.6rem 1rem;
        padding-left: 1.5rem;
        border-radius: 6px;
        text-decoration: none !important;
        transition: var(--transition);
        color: var(--text-secondary) !important;
        background: transparent !important;
        font-weight: 400;
        font-size: 0.9rem;
        position: relative;
    }

    .submenu a::before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--text-secondary);
        transition: var(--transition);
    }

    .submenu li.active a::before {
        background: var(--white);
        width: 6px;
        height: 6px;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
    }

    .submenu li:not(.active) a:hover {
        background: var(--white) !important;
        color: var(--orange-primary) !important;
        transform: translateX(4px);
        box-shadow: 0 2px 6px rgba(242, 135, 5, 0.15);
    }

    .submenu li:not(.active) a:hover::before {
        background: var(--orange-primary);
        width: 6px;
        height: 6px;
    }

    /* Submenu Visibility Animation */
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
        max-height: 500px;
        transform: translateY(0);
        margin-top: 0.5rem;
    }

    /* Submenu Item Staggered Animation */
    .submenu li {
        opacity: 0;
        transform: translateX(-15px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transition-delay: 0s;
    }

    .has-sub.active .submenu li {
        opacity: 1;
        transform: translateX(0);
    }

    .has-sub.active .submenu li:nth-child(1) { transition-delay: 0.05s; }
    .has-sub.active .submenu li:nth-child(2) { transition-delay: 0.1s; }
    .has-sub.active .submenu li:nth-child(3) { transition-delay: 0.15s; }
    .has-sub.active .submenu li:nth-child(4) { transition-delay: 0.2s; }
    .has-sub.active .submenu li:nth-child(5) { transition-delay: 0.25s; }

    /* Toggle Button */
    .sidebar-toggler {
        background: var(--orange-gradient) !important;
        border: none !important;
        color: var(--white) !important;
        border-radius: 8px;
        padding: 0.6rem;
        margin: 0.75rem;
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
        transition: var(--transition);
        cursor: pointer;
    }

    .sidebar-toggler:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.4);
    }

    .sidebar-toggler:active {
        transform: scale(0.95);
    }

    /* Reset Defaults */
    #sidebar ul {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Spacing */
    .sidebar-item:nth-child(1) {
        margin-bottom: 0.75rem;
    }

    .sidebar-item:nth-child(4) {
        margin-top: 0.75rem;
    }

    /* Scrollbar */
    .sidebar-menu::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #dee2e6;
        border-radius: 10px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: var(--text-secondary);
    }

    /* Remove conflicting styles */
    .sidebar-wrapper.sidebar-orange .sidebar-item:hover > .sidebar-link,
    .sidebar-wrapper.sidebar-orange .sidebar-item.active > .sidebar-link,
    .sidebar-wrapper.sidebar-orange .submenu li:hover > a {
        border-left: none !important;
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
                <li class="has-sub sidebar-item {{ Request::is('bencana*') || Request::is('kerusakan*') || Request::is('kerugian*') || Request::is('kebutuhan*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i data-feather="triangle"></i>           
                        <span>Jitupasna</span>
                    </a>                    
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('bencana.index') }}" class="sidebar-link">
                                <i data-feather="circle"></i>
                                <span>Bencana</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="submenu">
                        <li class="has-sub {{ Request::is('akibat*') ? 'active' : '' }}">
                            <a href="#" class="sidebar-link">
                                <i data-feather="circle"></i>
                                <span>Akibat</span>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="{{ route('kerusakan.list', ['source' => 'forms']) }}">
                                        <i data-feather="circle"></i>
                                        <span>Kerusakan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kerugian.list', ['source' => 'forms']) }}">
                                        <i data-feather="circle"></i>
                                        <span>Kerugian</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('forms.form-list', ['source' => 'forms']) }}">
                                        <i data-feather="circle"></i>
                                        <span>Formulir</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('bencana.index', ['source' => 'kebutuhan']) }}" class="sidebar-link">
                                <i data-feather="circle"></i>
                                <span>Kebutuhan</span>
                            </a>
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
        // Initialize submenu state - close all submenus except those with active submenu items
        document.querySelectorAll('.has-sub').forEach(function(item) {
            const submenu = item.querySelector('.submenu');
            const hasActiveChild = submenu && submenu.querySelector('li.active');
            
            // Only keep open if submenu has an active child
            if (!hasActiveChild) {
                item.classList.remove('active');
                submenu.classList.remove('active');
            }
        });

        // Handle sidebar submenu toggle
        const submenuToggles = document.querySelectorAll('.has-sub > .sidebar-link');

        submenuToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                const parentItem = this.parentElement;
                const isActive = parentItem.classList.contains('active');

                // // Close all other submenus with animation
                // document.querySelectorAll('.has-sub').forEach(function(item) {
                //     if (item !== parentItem && item.classList.contains('active')) {
                //         // Reset submenu items animation
                //         const submenuItems = item.querySelectorAll('.submenu li');
                //         submenuItems.forEach(function(item) {
                //             item.style.transitionDelay = '0s';
                //         });
                //         item.classList.remove('active');
                //     }
                // });

                // Only close siblings, not all .has-sub
                const siblings = Array.from(parentItem.parentElement.children)
                    .filter(el => el !== parentItem && el.classList.contains('has-sub'));

                siblings.forEach(function(item) {
                    if (item.classList.contains('active')) {
                        // Reset submenu items animation
                        const submenuItems = item.querySelectorAll('.submenu li');
                        submenuItems.forEach(function(item) {
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
                        item.style.transitionDelay = (0.05 + index * 0.05) + 's';
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

        // Handle sidebar toggle button (burger)
        const sidebarToggler = document.querySelector('.sidebar-toggler');
        const sidebar = document.getElementById('sidebar');
        
        if (sidebarToggler && sidebar) {
            sidebarToggler.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                sidebar.classList.toggle('active');
                
                // Also toggle the wrapper
                const wrapper = sidebar.querySelector('.sidebar-wrapper');
                if (wrapper) {
                    wrapper.classList.toggle('active');
                }
            });
        }

        // Initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
