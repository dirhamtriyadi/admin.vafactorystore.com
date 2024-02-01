@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Uang Kas</h1>
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
                            <h3 class="card-title">Edit Uang Kas</h3>

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
                                <a href="{{ route('cash-flow.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                            <form action="{{ route('cash-flow.update', $cashFlow->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="transaction_date" class="form-label">Tanggal *</label>
                                    <div class="input-group date mb-3" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="transaction_date" value="{{ old('transaction_date') ? old('transaction_date') : $cashFlow->transaction_date }}">
                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Nominal *</label>
                                    <input type="text" class="form-control mask-money" id="amount" name="amount" value="{{ old('amount') ? old('amount') : $cashFlow->amount }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="cash_flow_type" class="form-label">Type *</label>
                                        <select class="form-control select2" id="cash_flow_type" name="cash_flow_type">
                                            <option selected value="">-- Pilih Type --</option>
                                            <option value="UANGMASUK" {{ old('cash_flow_type') == "UANGMASUK" | $cashFlow->cash_flow_type == "UANGMASUK" ? 'selected' : '' }}>Uang Masuk</option>
                                            <option value="UANGKELUAR" {{ old('cash_flow_type') == "UANGKELUAR" | $cashFlow->cash_flow_type == "UANGKELUAR" ? 'selected' : '' }}>Uang Keluar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 d-none payment_method">
                                    <div class="form-group">
                                        <label for="payment_method_id" class="form-label">Jenis Pembayaran</label>
                                        <select class="form-control" id="payment_method_id" name="payment_method">
                                            <option selected value="">-- Pilih Type --</option>
                                            @foreach ($paymentMethods as $i => $paymentMethod)
                                                <option value="{{ $paymentMethod->id }}" {{ old('payment_method_id') == $paymentMethod->id | $cashFlow->payment_method_id == $paymentMethod->id ? 'selected' : ''  }}>{{ $paymentMethod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ? old('description') : $cashFlow->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <table>
                                        <tr>
                                            <td>Catatan: </td>
                                            <td>Kolom yang bertanda bintang (*) wajib diisi.</td>
                                        </tr>
                                    </table>
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
