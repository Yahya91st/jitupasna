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
                <li class="sidebar-item active ">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                @role('admin')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i>
                        <span>Kategori (Admin)</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="{{ route('kategori-bangunan.index') }}">Bangunan</a>
                        </li>
                        <li>
                            <a href="{{ route('kategori-bencana.index') }}">Bencana</a>
                        </li>
                        <li>
                            <a href="{{ route('satuan.index') }}">Satuan</a>
                        </li>
                        <li>
                            <a href="{{ route('hsd.index') }}">Harga Satuan Dasar</a>
                        </li>
                    </ul>
                </li>
                @endrole
                
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Jitupasna</span>
                    </a>
                    <ul class="submenu ">
                        @role('admin')
                        <li>
                            <a href="{{ route('bencana.index') }}">Bencana</a>
                        </li>
                        <li>
                            <a href="{{ route('kerusakan.index') }}">Kerusakan</a>
                        </li>
                        <li>
                            <a href="{{ route('kerugian.index') }}">Kerugian</a>
                        </li>
                        <li>
                            <a href="#">Kebutuhan</a>
                        </li>
                        @endrole
                        <li>
                            <a href="{{ route('bencana.index', ['source' => 'forms']) }}">Formulir</a>
                        </li>
                    </ul>
                </li>

                @role('admin')
                <li class="sidebar-item">
                    <a href="{{ route('users.index') }}" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
