@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Transaksi</h1>
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
                            <h3 class="card-title">Laporan transaksi</h3>

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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Nama Customer</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactionReports as $i => $transactionReport)
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            @foreach ($transactionReport->transactionDetails as $transactionDetail)
                                                @php
                                                    $totalPrice += $transactionDetail->total;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td>{{ $i +  + $transactionReports->firstitem() }}</td>
                                                <td>{{ $transactionReport->transaction_number }}</td>
                                                <td>{{ $transactionReport->customer->name }}</td>
                                                <td>{{ $transactionReport->date }}</td>
                                                <td>@money($totalPrice)</td>
                                                <td>
                                                    {{-- <a href="{{ route('transaction-report.show', $transactionReport->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                                    <a href="#" class="btn btn-info btn-sm btn-show" data-detail="{{ $transactionReport }}">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $transactionReports->links() }}
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

        {{-- Modal --}}
        <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="transaction_number" class="form-label">Nomor Transaksi</label>
                            <input type="text" class="form-control" id="transaction_number" name="transaction_number" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Nama Penginput/Edit</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="date" name="date" readonly>
                        </div>

                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-detail"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> --}}
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.btn-show').on('click', function () {
            let detail = $(this).data('detail');
            $('#modal-lg').modal('show');

            console.log(detail);

            $('.modal-title').text("Detail Order");
            $('#transaction_number').val(detail.transaction_number);
            $('#user_name').val(detail.user.name);
            $('#customer_name').val(detail.customer.name);
            $('#date').val(moment(detail.date).format('DD-MM-YYYY'));

            $.each(detail, function (indexInArray, valueOfElement) {
                if (indexInArray == 'transaction_details') {
                    $.each(valueOfElement, function (indexInArray, valueOfElement) {
                        $('#table-detail').append(`
                            <tr>
                                <td>${valueOfElement.product.code}</td>
                                <td>${valueOfElement.product.name}</td>
                                <td>${valueOfElement.qty}</td>
                                <td>${valueOfElement.price}</td>
                                <td>${valueOfElement.total}</td>
                            </tr>
                        `);
                    });
                }
            });
        })
    })
</script>
@endpush
