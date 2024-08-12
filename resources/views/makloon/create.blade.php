@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Maklun</h1>
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
                            <h3 class="card-title">Tambah Maklun</h3>

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
                                <a href="{{ route('makloon.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                            <form action="#" id="makloon-form">
                                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Maklun *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="customer_id" class="form-label">Pelanggan *</label>
                                        <select class="form-control select2" id="customer_id" name="customer_id">
                                            <option selected value="">-- Pilih Pelanggan --</option>
                                            @foreach ($customers as $i => $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : ''  }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal *</label>
                                    <div class="input-group date mb-3" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" value="{{ old('date') }}">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <table>
                                        <tr>
                                            <td>Catatan: </td>
                                            <td>Kolom yang bertanda bintang (*) wajib diisi.</td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div> --}}
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
            <div class="row">
                <div class="col-6">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Barang Maklun</h3>

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

                            <form action="#" id="add-item-makloon-form">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Barang *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Barang *</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="qty" class="form-label">Qty Barang *</label>
                                    <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga Barang *</label>
                                    <input type="text" class="form-control mask-money" id="price" name="price" value="{{ old('price') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="size" class="form-label">Ukuran Barang *</label>
                                    <input type="text" class="form-control" id="size" name="size" value="{{ old('size') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="unit" class="form-label">Satuan Barang *</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
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
                                    <button type="submit" href="#" class="btn btn-primary" id="add-item-makloon">Tambah</button>
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
                <div class="col-6">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Barang Maklun</h3>

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
                                <table id="table-item-makloon" class="table table-bordered table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kode barang</th>
                                            <th>Ukuran</th>
                                            <th>Satuan</th>
                                            <th>Deskripsi</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="btn btn-primary" id="save-makloon">Simpan Maklun</a>
                                </div>
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
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: '2000',
                timerProgressBar: true,
                didOpen: function(toast) {
                    $(toast.el).addClass('bg-success')
                },
                didClose: function(toast, reason) {
                    if (reason === 'timer') {
                        $(toast.el).removeClass('bg-success')
                    }
                }
            })

            localStorage.setItem('formData', JSON.stringify([]));
            let storedFormData = JSON.parse(localStorage.getItem('formData')) || [];
            let tableItemMakloon = $('#table-item-makloon');
            let tableItemMakloonBody = tableItemMakloon.find('tbody');
            tableItemMakloonBody.empty();
            let storedFormDataLength = storedFormData.length;
            let qty = 0;
            let price = 0;
            let total = 0;
            for (let i = 0; i < storedFormDataLength; i++) {
                qty += parseInt(storedFormData[i].qty);
                price += parseInt(storedFormData[i].price);
                total += parseInt(storedFormData[i].qty) * parseInt(storedFormData[i].price);
                let data = storedFormData[i];
                let tr = $('<tr>');
                tr.append($('<td>').text(i + 1));
                tr.append($('<td>').text(data.name));
                tr.append($('<td>').text(data.code));
                tr.append($('<td>').text(data.size));
                tr.append($('<td>').text(data.unit));
                tr.append($('<td>').text(data.qty));
                tr.append($('<td>').text("Rp. " + data.price.toLocaleString("id-ID")));
                tr.append($('<td>').text("Rp. " + (parseInt(data.qty) * parseInt(data.price)).toLocaleString("id-ID")));
                tr.append($('<td>').text(data.description));
                tr.append($('<td>').append($('<a>').attr('href', '#').addClass('btn btn-danger btn-sm').text('Hapus').on('click', function (e) {
                    e.preventDefault();
                    storedFormData.splice(i, 1);
                    localStorage.setItem('formData', JSON.stringify(storedFormData));
                    $(this).closest('tr').remove();
                })));
                tableItemMakloonBody.append(tr);
            }

            let tableItemMakloonFooter = tableItemMakloon.find('tfoot');
            let trFooter = $('<tr>');
            trFooter.append($('<td>').text('Total').attr({
                'colspan': 6,
                'class': 'text-center font-weight-bold'
            }));
            trFooter.append($('<td>').text(qty).addClass('font-weight-bold'));
            trFooter.append($('<td>').text("Rp. " + price.toLocaleString("id-ID")).addClass('font-weight-bold'));
            trFooter.append($('<td>').text("Rp. " + total.toLocaleString("id-ID")).addClass('font-weight-bold'));
            trFooter.append($('<td>').text('').attr('colspan', 4));
            tableItemMakloonFooter.append(trFooter);

            $('#add-item-makloon-form').on('submit', function (e) {
                e.preventDefault();
                let dataForm = {
                    name: $('#add-item-makloon-form #name').val(),
                    code: $('#add-item-makloon-form #code').val(),
                    size: $('#add-item-makloon-form #size').val(),
                    unit: $('#add-item-makloon-form #unit').val(),
                    description: $('#add-item-makloon-form #description').val(),
                    qty: $('#add-item-makloon-form #qty').val(),
                    price: $('#add-item-makloon-form #price').val(),
                }

                let storedFormData = JSON.parse(localStorage.getItem('formData')) || [];
                storedFormData.push(dataForm);
                localStorage.setItem('formData', JSON.stringify(storedFormData));

                console.log('add item makloon form', dataForm);

                $(this).trigger('reset');
                $('#add-item-makloon-form #price').val(0);
                $('#add-item-makloon-form #name').focus();

                let tableItemMakloon = $('#table-item-makloon');
                let tableItemMakloonBody = tableItemMakloon.find('tbody');
                tableItemMakloonBody.empty();
                let storedFormDataLength = storedFormData.length;
                let qty = 0;
                let price = 0;
                let total = 0;
                for (let i = 0; i < storedFormDataLength; i++) {
                    qty += parseInt(storedFormData[i].qty);
                    price += parseInt(storedFormData[i].price);
                    total += parseInt(storedFormData[i].qty) * parseInt(storedFormData[i].price);
                    let data = storedFormData[i];
                    let tr = $('<tr>');
                    tr.append($('<td>').text(i + 1));
                    tr.append($('<td>').text(data.name));
                    tr.append($('<td>').text(data.code));
                    tr.append($('<td>').text(data.size));
                    tr.append($('<td>').text(data.unit));
                    tr.append($('<td>').text(data.description));
                    tr.append($('<td>').text(data.qty));
                    tr.append($('<td>').text("Rp. " + data.price.toLocaleString("id-ID")));
                    tr.append($('<td>').text("Rp. " + (parseInt(data.qty) * parseInt(data.price)).toLocaleString("id-ID")));
                    tr.append($('<td>').append($('<a>').attr('href', '#').addClass('btn btn-danger btn-sm').text('Hapus').on('click', function (e) {
                        e.preventDefault();
                        storedFormData.splice(i, 1);
                        localStorage.setItem('formData', JSON.stringify(storedFormData));
                        $(this).closest('tr').remove();
                    })));
                    tableItemMakloonBody.append(tr);
                }

                let tableItemMakloonFooter = tableItemMakloon.find('tfoot');
                tableItemMakloonFooter.empty();
                let trFooter = $('<tr>');
                trFooter.append($('<td>').text('Total').attr({
                    'colspan': 6,
                    'class': 'text-center font-weight-bold'
                }));
                trFooter.append($('<td>').text(qty).addClass('font-weight-bold'));
                trFooter.append($('<td>').text("Rp. " + price.toLocaleString("id-ID")).addClass('font-weight-bold'));
                trFooter.append($('<td>').text("Rp. " + total.toLocaleString("id-ID")).addClass('font-weight-bold'));
                trFooter.append($('<td>').text('').attr('colspan', 4));
                tableItemMakloonFooter.append(trFooter);

            });

            $('#save-makloon').on('click', function (e) {
                e.preventDefault();
                let storedFormData = JSON.parse(localStorage.getItem('formData')) || [];
                let user_id = $('#user_id').val();
                let customer_id = $('#customer_id').val();
                let name = $('#name').val();
                let description = $('#description').val();
                let date = $('#reservationdate').find('input').val();

                let data = {
                    _token: "{{ csrf_token() }}",
                    user_id: user_id,
                    customer_id: customer_id,
                    name: name,
                    description: description,
                    date: date,
                    items: storedFormData
                }

                data.items = storedFormData;
                console.log('makloon form', data);
                $.ajax({
                    url: "{{ route('makloon.store') }}",
                    method: 'POST',
                    data: data,
                    success: function (response) {
                        console.log('response', response);
                        localStorage.removeItem('formData');
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        }).then(function () {
                            window.location.href = "{{ route('makloon.index') }}";
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('error', error);
                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.message
                        });
                    }
                });
            });
        });
    </script>
@endpush
