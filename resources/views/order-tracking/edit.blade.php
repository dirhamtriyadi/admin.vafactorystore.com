@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Order Pelacakan</h1>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Order Pelacakan</h3>

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
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('order.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                            <form action="{{ route('order.update', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Order</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ? old('name') : $order->name }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="customer_id" class="form-label">Pelanggan</label>
                                        <select class="form-control select2" id="customer_id" name="customer_id">
                                            <option selected value="">-- Pilih Pelanggan --</option>
                                            @foreach ($customers as $i => $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id | $order->customer_id == $customer->id ? 'selected' : ''  }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="print_type_id" class="form-label">Kategori</label>
                                        <select class="form-control select2" id="print_type_id" name="print_type_id">
                                            <option selected value="">-- Pilih Kategori --</option>
                                            @foreach ($printTypes as $i => $printType)
                                                <option value="{{ $printType->id }}" {{ old('print_type_id') == $printType->id | $order->print_type_id == $printType->id ? 'selected' : ''  }} data-print_type="{{ $printType }}">{{ $printType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="qty" class="form-label">Qty</label>
                                    <input type="number=" class="form-control" id="qty" name="qty" value="{{ old('qty') ? old('qty') : $order->qty }}">
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text=" class="form-control mask-money" id="price" name="price" value="{{ old('price') ? old('price') : $order->price }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="subtotal" class="form-label">Sub Total</label>
                                    <input type="text=" class="form-control mask-money" id="subtotal" name="subtotal" value="{{ old('subtotal') ? old('subtotal') : $order->subtotal }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="discount" class="form-label">Diskon</label>
                                    <input type="text=" class="form-control mask-money" id="discount" name="discount" value="{{ old('discount') ? old('discount') : $order->discount }}">
                                </div>

                                <div class="mb-3">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text=" class="form-control mask-money" id="total" name="total" value="{{ old('total') ? old('total') : $order->total }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ? old('description') : $order->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal</label>
                                    <div class="input-group date mb-3" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" value="{{ old('date') ? old('date') : $order->date }}">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
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
            if ($('#cash_flow_type').find(':selected').val() == 'UANGMASUK') {
                    // console.log('masuk');
                    $('.payment_method').removeClass('d-none');
                } else {
                    // console.log('keluar');
                    $('.payment_method').addClass('d-none');
                }

            $('#cash_flow_type').change(function () {
                console.log($('#cash_flow_type option:selected').val());
                if ($('#cash_flow_type').find(':selected').val() == 'UANGMASUK') {
                    // console.log('masuk');
                    $('.payment_method').removeClass('d-none');
                } else {
                    // console.log('keluar');
                    $('.payment_method').addClass('d-none');
                }
            })
        })
    </script>
@endpush
