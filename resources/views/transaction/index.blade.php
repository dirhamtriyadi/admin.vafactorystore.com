@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transaksi Penjualan</h1>
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
                <section class="col-lg-8 connectedSortable">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Penjualan</h3>

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
                            <div class="d-flex flex-column mb-3">
                                <div class="d-flex flex-wrap">
                                    <div class="form-group mr-3">
                                        <label for="product_id">Kode/Nama Barang</label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="product_id" id="product_id">
                                            <option selected="selected" data-select2-id="" value="">-- Pilih Product --</option>
                                            @foreach ($products as $i => $product)
                                                <option value="{{ $product->id }}" data-product="{{ $product }}" data-select2-id="{{ $product->id }}">{{ $product->code }}-{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-3">
                                        <label class="form-label" for="description">Nama Barang</label>
                                        <input type="text" class="form-control" id="description" name="description" readonly>
                                    </div>
                                    <div class="form-group mr-3">
                                        <label class="form-label" for="price">Harga</label>
                                        <input type="text" class="form-control mask-money" id="price" name="price">
                                    </div>
                                    <div class="form-group mr-3">
                                        <label class="form-label" for="qty">Quantity Pembelian</label>
                                        <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty') }}">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-primary btn-submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Penjualan</h3>

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
                            <form>
                                <div class="d-flex flex-column mb-3">
                                    <div class="d-flex flex-wrap">
                                        <div class="form-group mr-3">
                                            <label for="customer_id">Pilih Customer</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" name="customer_id" id="customer_id">
                                                <option selected="selected" data-select2-id="" value="">-- Pilih Customer --</option>
                                                @foreach ($customers as $i => $customer)
                                                    <option value="{{ $customer->id }}" data-customer="{{ $customer }}" data-select2-id="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex">
                                            <div class="form-group mr-3">
                                                <label for="payment_method_id">Jenis Pembayaran</label>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" name="payment_method_id" id="payment_method_id">
                                                    <option selected="selected" data-select2-id="" value="">-- Pilih Jenis Pembayaran --</option>
                                                    @foreach ($paymentMethods as $i => $paymentMethod)
                                                        <option value="{{ $paymentMethod->id }}" data-paymentMethod="{{ $paymentMethod }}" data-select2-id="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap mb-3">
                                    <div class="mr-2">
                                        <p class="text-bold">Total</p>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control mask-money" id="total" name="total" value="0" readonly>
                                        {{-- <p id="total" class="text-bold">0</p> --}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="d-flex">
                                        <p class="text-bold">CASH</p>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control mask-money" id="cash" name="cash" value="0">
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between flex-wrap mb-3">
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="2000">+2.000</a>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="5000">+5.000</a>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="10000">+10.000</a>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between flex-wrap mb-3">
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="20000">+20.000</a>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="50000">+50.000</a>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-outline-primary" style="width: 90px" id="100000">+100.000</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <a class="btn btn-danger form-control" id="btn-reset">Reset</a>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="mr-2">
                                        <p class="text-bold" id="status"></p>
                                    </div>
                                    <div>
                                        <input type="text" id="status-cash" class="form-control mask-money" value="0" readonly>
                                        {{-- <p id="status-cash" class="text-bold money">0</p> --}}
                                    </div>
                                </div>
                                <input type="hidden" name="date" id="date">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="items[]" id="items">
                                <div>
                                    <a class="btn btn-primary form-control" id="btn-buy">Bayar</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function formatIDR(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
    }

    $(function () {
        $('.select2').select2({
            placeholder: 'select..'
        })

        $('#date').val(moment().format('YYYY-MM-DD'));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let dataLocalStorage = JSON.parse(localStorage.getItem('product'));
        let totalCheckout = 0;
        let hasil = 0;
        let cash = parseInt($('#cash').val());
        let totalStatus = 0;

        if (dataLocalStorage) {
            $.each(dataLocalStorage, function (indexInArray, valueOfElement) {
                totalCheckout += parseInt(valueOfElement.total);
                totalStatus -= parseInt(valueOfElement.total);

                formattedPrice = formatIDR(valueOfElement.price);
                formattedTotal = formatIDR(valueOfElement.total);

                let html = `
                    <tr>
                        <td>${valueOfElement.code}</td>
                        <td>${valueOfElement.description}</td>
                        <td>${valueOfElement.qty}</td>
                        <td>${formattedPrice}</td>
                        <td>${formattedTotal}</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-delete" data-table="${valueOfElement.code}">Hapus</button>
                        </td>
                    </tr>
                `;
                $('tbody').append(html);

                $('#total').val(totalCheckout);
                $('#status-cash').val(totalStatus);
            });
        }

        if (hasil > 0) {
            $('#status').text('Kembalian');
        } else {
            $('#status').text('Kurang');
        }

        $('#cash').on('keyup', function() {
            let cash = $(this).val();
            let total = $('#total').val();
            let hasil = parseInt(cash) - parseInt(total);
            if (hasil > 0) {
                $('#status-cash').val(hasil);
                $('#status').text('Kembalian');
            } else {
                $('#status-cash').val(hasil);
                $('#status').text('Kurang');
            }
        });

        $('#product_id').on('change', function() {
            let product = $(this).find(':selected').data('product');
            $('#description').val(product.name);
            $('#price').val(product.price);
            $('#qty').val();
        });

        $('#2000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 2000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#5000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 5000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#10000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 10000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#20000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 20000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#50000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 50000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#100000').on('click', function() {
            $('#cash').trigger('keyup');
            cash = parseInt($('#cash').val());
            cash += 100000;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });

        $('#btn-reset').on('click', function() {
            $('#cash').trigger('keyup');
            cash = 0;
            $('#cash').val(cash);
            $('#cash').trigger('keyup');
        });
    })

    $('.btn-submit').on('click', function() {
        let product = $('#product_id').find(':selected').data('product');
        let product_id = $('#product_id').find(':selected').val();
        let price = $('#price').val();
        let qty = $('#qty').val();
        let total = price * qty;
        let description = $('#description').val();
        let totalCheckout = 0;

        let data;
        data = {'product_id' : product_id, 'code' : product.code, 'description' : description, 'price' : price, 'qty' : qty, 'total' : total}

        let dataLocalStorage = JSON.parse(localStorage.getItem('product'));

        let hasil;
        $.each(dataLocalStorage, function (indexInArray, valueOfElement) {
            if (valueOfElement.code === product.code) {
                hasil = true;
                return;
            }
        });

        if(hasil){
            Swal.fire({
                icon: "error",
                title: "Oops... Tidak bisa menambahkan data!",
                text: "Data "+data.code+" sudah ada!",
                footer: '<a href="{{ route('transaction.index') }}">Kembali ke transaksi?</a>'
            });
            return;
        }

        if(!dataLocalStorage || dataLocalStorage.length == 0 || dataLocalStorage == null){
            totalCheckout = total;
        } else {
            $.each(dataLocalStorage, function (indexInArray, valueOfElement) {
                totalCheckout += parseInt(valueOfElement.total);
            });
            totalCheckout += total;
        }

        $('#total').val(totalCheckout);
        $('#status-cash').val(parseInt($('#cash').val()) - totalCheckout);

        if (dataLocalStorage != null) {
            // console.log('ini di if', dataLocalStorage);
            dataLocalStorage.push(data);
            localStorage.setItem('product', JSON.stringify(dataLocalStorage));
        } else {
            // console.log('ini else');
            localStorage.setItem('product', JSON.stringify([data]));
        }

        formattedPrice = formatIDR(price);
        formattedTotal = formatIDR(total);

        let html = `
            <tr>
                td>${product_id}</td>
                <td>${product.code}</td>
                <td>${description}</td>
                <td>${qty}</td>
                <td>${formattedPrice}</td>
                <td>${formattedTotal}</td>
                <td>
                    <button class="btn btn-danger btn-sm btn-delete" data-table="${product.code}">Hapus</button>
                </td>
            </tr>
        `;
        $('tbody').append(html);
    });

    $('#btn-buy').on('click', function() {
        let totalcheckout = $('#total').val();
        let cash = $('#cash').val();

        if(cash >= totalcheckout){
            $.ajax({
            type: "POST",
            url: "{{ route('transaction.store') }}",
            data: {
                'items' : JSON.parse(localStorage.getItem('product')),
                'date' : $('#date').val(),
                'user_id' : $('#user_id').val(),
                'customer_id' : $('#customer_id').val(),
                'payment_method_id' : $('#payment_method_id').val(),
                'cash' : $('#cash').val(),
                'total' : $('#total').val(),
                '_token' : '{{ csrf_token() }}'
            },
            dataType: 'JSON',
            success: function (response) {
                localStorage.removeItem('product');
                Swal.fire({
                    title: "Berhasil!",
                    text: response.message+"!",
                    icon: "success"

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('transaction.index') }}";
                    }
                });
            },
            error: function (response) {
                console.log(response);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="{{ route('transaction.index') }}">Kembali ke transaksi?</a>'
                });
            }
        });
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...!",
                text: "Uang masih kurang!",
                footer: '<a href="{{ route('transaction.index') }}">Kembali ke transaksi?</a>'
            });
        }
    });

    $('tbody').on('click', '.btn-delete', function() {
        let product_code = $(this).data('table');
        $(this).closest('tr').remove();

        let dataLocalStorage = JSON.parse(localStorage.getItem('product'));

        let hasil;
        let data;
        $.each(dataLocalStorage, function (indexInArray, valueOfElement) {
            if (valueOfElement.code === product_code) {
                data = valueOfElement;
                hasil = indexInArray;
                return;
            }
        });

        dataLocalStorage.splice(hasil, 1);
        localStorage.setItem('product', JSON.stringify(dataLocalStorage));

        let totalCheckout = parseInt($('#total').val());
        let totalStatus = parseInt($('#status-cash').val());

        $('#total').val(totalCheckout - parseInt(data.total));
        $('#status-cash').val(totalStatus + parseInt(data.total));

        $('#cash').trigger('keyup');
    });
</script>
@endpush
