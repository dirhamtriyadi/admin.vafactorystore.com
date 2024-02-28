<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('') }}favicon.ico" alt="AdminLTE Logo"
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
                {{-- @canany(['dashboard-list', 'dashboard-create', 'dashboard-edit', 'dashboard-delete'])
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endcanany --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @canany(['customer-list', 'customer-create', 'customer-edit', 'customer-delete'])
                    <li class="nav-item">
                        <a href="{{ route('customer.index') }}" class="nav-link {{ Route::is('customer.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Pelanggan
                            </p>
                        </a>
                    </li>
                @endcanany
                @canany(['transaction-list', 'transaction-create', 'transaction-edit', 'transaction-delete', 'transaction-report-list', 'transaction-report-create', 'transaction-report-edit', 'transaction-report-delete', 'product-list', 'product-create', 'product-edit', 'product-delete'])
                    <li class="nav-item {{ Route::is('transaction.*') | Route::is('transaction-report.*') | Route::is('product.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('transaction.*') | Route::is('transaction-report.*') | Route::is('product.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-store"></i>
                            <p>
                                Penjualan Toko
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['transaction-list', 'transaction-create', 'transaction-edit', 'transaction-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('transaction.index') }}" class="nav-link {{ Route::is('transaction.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Penjualan</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['transaction-report-list', 'transaction-report-create', 'transaction-report-edit', 'transaction-report-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('transaction-report.index') }}" class="nav-link {{ Route::is('transaction-report.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lihat Penjualan</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['product-list', 'product-create', 'product-edit', 'product-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Barang</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['order-list', 'order-create', 'order-edit', 'order-delete', 'order-transaction-list', 'order-transaction-create', 'order-transaction-edit', 'order-transaction-delete', 'order-tracking-list', 'order-tracking-create', 'order-tracking-edit', 'order-tracking-delete'])
                    <li class="nav-item {{ Route::is('order.*') | Route::is('order-transaction.*') | Route::is('order-tracking.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('order.*') | Route::is('order-transaction.*') | Route::is('order-tracking.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Order
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['order-list', 'order-create', 'order-edit', 'order-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('order.index') }}" class="nav-link {{ Route::is('order.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['order-transaction-list', 'order-transaction-create', 'order-transaction-edit', 'order-transaction-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('order-transaction.index') }}" class="nav-link {{ Route::is('order-transaction.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order Transaksi</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['order-tracking-list', 'order-tracking-create', 'order-tracking-edit', 'order-tracking-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('order-tracking.index') }}" class="nav-link {{ Route::is('order-tracking.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Order Pelacakan</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                <li class="nav-item {{ Route::is('makloon.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('makloon.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Maklun
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('makloon.index') }}" class="nav-link {{ Route::is('makloon.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Maklun</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Maklun Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @canany(['cashflow-list', 'cashflow-create', 'cashflow-edit', 'cashflow-delete', 'cashflow-report-list', 'cashflow-report-create', 'cashflow-report-edit', 'cashflow-report-delete'])
                    <li class="nav-item {{ Route::is('cash-flow.*') | Route::is('cash-flow-report.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('cash-flow.*') | Route::is('cash-flow-report.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>
                                Uang Kas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['cashflow-list', 'cashflow-create', 'cashflow-edit', 'cashflow-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('cash-flow.index') }}" class="nav-link {{ Route::is('cash-flow.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Uang Kas</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['cashflow-report-list', 'cashflow-report-create', 'cashflow-report-edit', 'cashflow-report-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('cash-flow-report.index') }}" class="nav-link {{ Route::is('cash-flow-report.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Uang Kas</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['payment-method-list', 'payment-method-create', 'payment-method-edit', 'payment-method-delete', 'print-type-list', 'print-type-create', 'print-type-edit', 'print-type-delete', 'tracking-list', 'tracking-create', 'tracking-edit', 'tracking-delete'])
                    <li class="nav-item {{ Route::is('payment-method.*') | Route::is('print-type.*') | Route::is('tracking.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('payment-method.*') | Route::is('print-type.*') | Route::is('tracking.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['payment-method-list', 'payment-method-create', 'payment-method-edit', 'payment-method-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('payment-method.index') }}" class="nav-link {{ Route::is('payment-method.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Pembayaran</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['print-type-list', 'print-type-create', 'print-type-edit', 'print-type-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('print-type.index') }}" class="nav-link {{ Route::is('print-type.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['tracking-list', 'tracking-create', 'tracking-edit', 'tracking-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('tracking.index') }}" class="nav-link {{ Route::is('tracking.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pelacakan</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['user-list', 'user-create', 'user-edit', 'user-delete'])
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Data User
                            </p>
                        </a>
                    </li>
                @endcanany
                @canany(['role-list', 'role-create', 'role-edit', 'role-delete'])
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-user-lock"></i>
                            <p>
                                Hak Akses
                            </p>
                        </a>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
