@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Laporan Uang Kas</h1>
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
                            <h3 class="card-title">Data Laporan Uang Kas</h3>

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
                            <div class="d-flex flex-row justify-content-between mb-3">
                                <div class="d-flex flex-col">
                                    <form action="{{ route('cash-flow-report.index') }}" method="GET">
                                        <div class="d-flex flex-col">
                                            <div class="mr-3">
                                                <label for="start_date" class="form-label">Tanggal Dari</label>
                                                <div class="input-group date mb-3" id="start_date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date" value="{{ old('start_date') ? old('start_date') : $start_date }}">
                                                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mr-3">
                                                <label for="end_date" class="form-label">Tanggal Sampai</label>
                                                <div class="input-group date mb-3" id="end_date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date" value="{{ old('end_date') ? old('end_date') : $end_date }}">
                                                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="perPage" value="{{ $perPage }}">
                                            <div class="d-flex align-items-center">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('cash-flow-report.index') }}" method="GET">
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
                                            <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
                                            <option value="500" {{ $perPage == 500 ? 'selected' : '' }}>500</option>
                                            <option value="1000" {{ $perPage == 1000 ? 'selected' : '' }}>1000</option>
                                            <option value="5000" {{ $perPage == 5000 ? 'selected' : '' }}>5000</option>
                                            <option value="10000" {{ $perPage == 10000 ? 'selected' : '' }}>10000</option>
                                        </select>
                                        <input type="hidden" name="start_date" value="{{ $start_date }}">
                                        <input type="hidden" name="end_date" value="{{ $end_date }}">
                                        <button type="submit" class="btn btn-primary ml-3">Apply</button>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-end mb-3">
                                <form action="{{ route('cash-flow-report.print') }}" method="GET">
                                    <div class="d-flex flex-col">
                                        <input type="hidden" name="start_date" value="{{ $start_date }}">
                                        <input type="hidden" name="end_date" value="{{ $end_date }}">
                                        <div class="d-flex align-items-center">
                                            <button type="submit" class="btn btn-primary">Print</button>
                                        </div>
                                    </div>
                                </form>
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
                                                    <td>{{ $i + $cashFlows->firstitem() }}</td>
                                                    <td>{{ $cashFlow->cash_flow_type }}</td>
                                                    <td>{{ $cashFlow->description }}</td>
                                                    <td>{{ $cashFlow->user->name }}</td>
                                                    <td>{{ $cashFlow->transaction_date }}</td>
                                                    <td>@money($cashFlow->amount)</td>
                                                </tr>
                                            @else
                                                <tr class="table-danger">
                                                    <td>{{ $i + $cashFlows->firstitem() }}</td>
                                                    <td>{{ $cashFlow->cash_flow_type }}</td>
                                                    <td>{{ $cashFlow->description }}</td>
                                                    <td>{{ $cashFlow->user->name }}</td>
                                                    <td>{{ $cashFlow->transaction_date }}</td>
                                                    <td>@money($cashFlow->amount)</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Masuk</b></td>
                                            <td class="text-success"><b>@money($totalUangMasuk)</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Keluar</b></td>
                                            <td class="text-danger"><b>@money($totalUangKeluar)</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><b>Total Uang Kas</b></td>
                                            <td><b>@money($totalUangKas)</b></td>
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
    <script>
        $(function () {
            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endpush
