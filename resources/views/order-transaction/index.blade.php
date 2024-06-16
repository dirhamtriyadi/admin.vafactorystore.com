@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Order Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Fixed Layout</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('main-content')
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Data Order Transaksi</h3>

                            {{-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-end mb-3">
                                <div class="d-flex justify-content-end">
                                    @can('order-transaction.create')
                                        <a href="{{ route('order-transaction.create') }}" class="btn btn-primary mb-3">Tambah Order Transaksi</a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('order-transaction.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Order Transaksi" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('order-transaction.index') }}" method="GET">
                                            <input type="hidden" name="search" value="{{ $search }}">
                                            <div class="input-group">
                                                <select name="perPage" class="select" id="perPage">
                                                    <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                                                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="7" {{ $perPage == 7 ? 'selected' : '' }}>7</option>
                                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary ml-3">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Order</th>
                                            <th>Nama Penginput</th>
                                            <th>Kategori Pembayaran</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderTransactions as $i => $orderTransaction)
                                            <tr>
                                                <td>{{ $i + $orderTransactions->firstitem() }}</td>
                                                <td>{{ $orderTransaction->order->order_number }}</td>
                                                <td>{{ $orderTransaction->user->name }}</td>
                                                <td>{{ $orderTransaction->paymentMethod->name }}</td>
                                                <td>@money($orderTransaction->amount)</td>
                                                <td>{{ $orderTransaction->description }}</td>
                                                <td>{{ $orderTransaction->date }}</td>
                                                <td>
                                                    @can('order-transaction.edit')
                                                        <a href="{{ route('order-transaction.edit', $orderTransaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    @can('order-transaction.delete')
                                                        <form action="{{ route('order-transaction.destroy', $orderTransaction->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $orderTransactions->links() !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
