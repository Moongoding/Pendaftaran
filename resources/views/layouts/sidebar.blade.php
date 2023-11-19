<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="/template/assets/images/logos/dark-logo.svg" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super_Admin'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Admin</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('reservasi*') ? 'active': '' }}" href="/reservasi"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Pendaftaran Analisa</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('riwayat*') ? 'active': '' }}" href="/riwayat"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Riwayat Analisa</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Pengaturan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ $active }}" href="/home" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('analisa*') ? 'active': '' }}" href="/analisa"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-3d-cube-sphere"></i>
                            </span>
                            <span class="hide-menu">Analisa</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('parameter*') ? 'active': '' }}" href="/parameter"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-sitemap"></i>
                            </span>
                            <span class="hide-menu">Parameter</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('metode*') ? 'active': '' }}" href="/metode"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-augmented-reality"></i>
                            </span>
                            <span class="hide-menu">Metode</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('category*') ? 'active': '' }}" href="/category"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-category-2"></i>
                            </span>
                            <span class="hide-menu">Category Parameter</span>
                        </a>
                    </li>
                @else
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Hi {{ auth()->user()->name }}</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('reservasi*') ? 'active': '' }}" href="/reservasi"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('riwayat*') ? 'active': '' }}" href="/riwayat"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Riwayat Analisa</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('Super_Admin'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Pengaturan Users</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('users*') ? 'active': '' }}" href="/users"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-user-circle"></i>
                            </span>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
