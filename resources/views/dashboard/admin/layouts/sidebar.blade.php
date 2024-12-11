<aside class="left-sidebar with-vertical">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div>
                <img src="{{ asset('assets/images/logos/LOGO_RS.png') }}" width="50" height="50">
            </div>
            <div>
                <p class="fs-4 fw-bold mt-3" style="">Website Inventaris</p>
            </div>
            <div>
                <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                    <i class="ti ti-x"></i>
                </a>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->can('dashboard'))
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endif
                @can('data.master')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">
                            Data Master
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('jenis-barang.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Jenis Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('merk-barang.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Merk Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('kondisi-barang.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Kondisi Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('sumber-pengadaan.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Sumber Pengadaan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('unit-kerja.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Unit Kerja</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('distributor.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Distributor</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('vendor.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Data Vendor</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Barang</span>
                </li>
                @can('read.barang')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('barang.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Data Barang</span>
                    </a>
                </li>
                @endcan
                @can('barang.dihapus')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('barang.trash') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-folder-minus"></i>
                </span>
                        <span class="hide-menu">Data Barang Dihapus</span>
                    </a>
                </li>
                @endcan
                @can('create.barang')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('barang.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Tambah Barang</span>
                    </a>
                </li>
                @endcan
                @can('update.barang')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kalibrasi.barang.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-certificate"></i>
                        </span>
                            <span class="hide-menu">Kalibrasi Barang</span>
                        </a>
                    </li>
                @endcan

                @can('maintenance')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Maintenance</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('maintenance.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-warehouse"></i>
                        </span>
                        <span class="hide-menu">Data Maintenance</span>
                    </a>
                </li>
                @endcan
                @can('maintenance.lanjut')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('maintenance.lanjutan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-hammer"></i>
                        </span>
                        <span class="hide-menu">Data Maintenance Lanjutan</span>
                    </a>
                </li>
                @endcan
                @can('maintenance.rusak')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('maintenance.rusak.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home-minus"></i>
                        </span>
                        <span class="hide-menu">Data Barang Rusak</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('penggantian.barang.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-home-eco"></i>
                    </span>
                        <span class="hide-menu">Data Barang Pergantian</span>
                    </a>
                </li>
                @endcan
                @can('maintenance.diperbaiki')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('maintenance.diperbaiki.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home-plus"></i>
                        </span>
                        <span class="hide-menu">Data Barang Berhasil Perbaikan</span>
                    </a>
                </li>
                @endcan

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Logs</span>
                </li>
                @can('log.maintenance')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('log.maintenance') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-barcode"></i>
                        </span>
                        <span class="hide-menu">Log Maintenance</span>
                    </a>
                </li>
                @endcan
                @can('log.persetujuan.maintenance')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('log.persetujuan.maintenance') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-check"></i>
                        </span>
                        <span class="hide-menu">Log Persetujuan Maintenance</span>
                    </a>
                </li>
                @endcan
                @can('log.barang.dihapus')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('log.barang') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-folder-off"></i>
                </span>
                        <span class="hide-menu">Log Barang Dihapus</span>
                    </a>
                </li>
                @endcan

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">User & Roles</span>
                </li>
                @can('users')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Tambah Users</span>
                    </a>
                </li>
                @endcan
                @can('roles')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-circle"></i>
                        </span>
                        <span class="hide-menu">Data Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('roles.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-circle"></i>
                        </span>
                        <span class="hide-menu">Tambah Roles</span>
                    </a>
                </li>
                @endcan
                @can('permission')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-license"></i>
                        </span>
                        <span class="hide-menu">Data Permissions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('permissions.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-license"></i>
                        </span>
                        <span class="hide-menu">Tambah Permissions</span>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="{{ asset('assets/images/profile/itdh.jpeg') }}" class="rounded-circle" width="40" height="40" alt="modernize-img">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">{{ auth()->user()->name }}</h6>
                    <span class="fs-2">{{ auth()->user()->role->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sidebar scroll-->
</aside>
