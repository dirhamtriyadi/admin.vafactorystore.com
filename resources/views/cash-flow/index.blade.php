@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Uang Kas</h1>
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
                            <h3 class="card-title">Data Uang Kas</h3>

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
                            <div class="d-flex flex-column justify-content-end">
                                <div class="d-flex justify-content-end">
                                    @can('cashflow-create')
                                        <a href="{{ route('cash-flow.create') }}" class="btn btn-primary mb-3">Tambah Uang Kas</a>
                                    @endcan
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <form action="{{ route('cash-flow.index') }}" method="GET">
                                        <select name="perPage" id="perPage">
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
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Type</th>
                                            <th>Deskripsi</th>
                                            <th>Nama Penginput</th>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalUangMasuk = 0;
                                            $totalUangKeluar = 0;
                                            $totalUangKas = 0;
                                        @endphp
                                        @foreach ($cashFlows as $i => $cashFlow)
                                            @if ($cashFlow->cash_flow_type === "UANGMASUK")
                                                @php
                                                    $totalUangMasuk += $cashFlow->amount;
                                                    $totalUangKas += $cashFlow->amount;
                                                @endphp
                                            @else
                                                @php
                                                    $totalUangKeluar += $cashFlow->amount;
                                                    $totalUangKas -= $cashFlow->amount;
                                                @endphp
                                            @endif

                                            @if ($cashFlow->cash_flow_type === "UANGMASUK")
                                                <tr class="table-success">
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $cashFlow->cash_flow_type }}</td>
                                                    <td>{{ $cashFlow->description }}</td>
                                                    <td>{{ $cashFlow->user->name }}</td>
                                                    <td>{{ $cashFlow->created_at }}</td>
                                                    <td>@money($cashFlow->amount)</td>
                                                    <td>
                                                        @can('cashflow-edit')
                                                            <a href="{{ route('cash-flow.edit', $cashFlow->id) }}" class="btn btn-warning">Edit</a>
                                                        @endcan
                                                        @can('cashflow-delete')
                                                            <form action="{{ route('cash-flow.destroy', $cashFlow->id) }}" method="post" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="table-danger">
                                                    <td>{{ $i + $cashFlows->firstitem() }}</td>
                                                    <td>{{ $cashFlow->cash_flow_type }}</td>
                                                    <td>{{ $cashFlow->description }}</td>
                                                    <td>{{ $cashFlow->user->name }}</td>
                                                    <td>{{ $cashFlow->transaction_date }}</td>
                                                    <td>@money($cashFlow->amount)</td>
                                                    <td>
                                                        <a href="{{ route('cash-flow.edit', $cashFlow->id) }}" class="btn btn-warning">Edit</a>
                                                        <form action="{{ route('cash-flow.destroy', $cashFlow->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Masuk</b></td>
                                            <td class="text-success"><b>@money($totalUangMasuk)</b></td>
                                            <td colspan="1"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Keluar</b></td>
                                            <td class="text-danger"><b>@money($totalUangKeluar)</b></td>
                                            <td colspan="1"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Kas</b></td>
                                            <td><b>@money($totalUangKas)</b></td>
                                            <td colspan="1"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                {!! $cashFlows->links() !!}
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
