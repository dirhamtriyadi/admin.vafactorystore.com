<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.index') }}" class="nav-link {{ Route::is('customer.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('transaction.*') | Route::is('transaction-report.*') | Route::is('product.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('transaction.*') | Route::is('transaction-report.*') | Route::is('product.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Penjualan Toko
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('transaction.index') }}" class="nav-link {{ Route::is('transaction.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction-report.index') }}" class="nav-link {{ Route::is('transaction-report.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('order.*') | Route::is('order-transaction.*') | Route::is('order-tracking.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('order.*') | Route::is('order-transaction.*') | Route::is('order-tracking.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Order
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link {{ Route::is('order.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order-transaction.index') }}" class="nav-link {{ Route::is('order-transaction.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order-tracking.index') }}" class="nav-link {{ Route::is('order-tracking.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Pelacakan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('cash-flow.*') | Route::is('cash-flow-report.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('cash-flow.*') | Route::is('cash-flow-report.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            Uang Kas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cash-flow.index') }}" class="nav-link {{ Route::is('cash-flow.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Uang Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cash-flow-report.index') }}" class="nav-link {{ Route::is('cash-flow-report.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Uang Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('payment-method.*') | Route::is('print-type.*') | Route::is('tracking.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('payment-method.*') | Route::is('print-type.*') | Route::is('tracking.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payment-method.index') }}" class="nav-link {{ Route::is('payment-method.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('print-type.index') }}" class="nav-link {{ Route::is('print-type.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tracking.index') }}" class="nav-link {{ Route::is('tracking.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pelacakan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Data User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-lock"></i>
                        <p>
                            Hak Akses
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
