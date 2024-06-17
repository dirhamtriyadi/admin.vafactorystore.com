@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Order</h1>
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
                            <h3 class="card-title">List Data Order</h3>

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
                                    @can('order.create')
                                        <a href="{{ route('order.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('order.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Order" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('order.index') }}" method="GET">
                                            <input type="hidden" name="search" value="{{ $search }}">
                                            <div class="input-group">
                                                <select name="perPage" class="select" id="perPage">
                                                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
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
                                            <th>Nama Pelanggan</th>
                                            <th>Kategori</th>
                                            <th>Nama Order</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $i => $order)
                                            <tr>
                                                <td>{{ $i + $orders->firstitem() }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ isset($order->createdBy->name) ? $order->createdBy->name : '' }}</td>
                                                <td>{{ $order->customer->name }}</td>
                                                <td>{{ $order->printType->name }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->date }}</td>
                                                <td>
                                                    @can('order.edit')
                                                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    <a href="#" class="btn btn-info btn-sm btn-show" data-detail="{{ $order }}">Detail</a>
                                                    @can('order.delete')
                                                        <form action="{{ route('order.destroy', $order->id) }}" method="post" class="d-inline">
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
                                {!! $orders->links() !!}
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
                            <label for="order_number" class="form-label">Nomor Order</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Order</label>
                            <input type="text" class="form-control" id="name" name="name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="created_by" class="form-label">Nama Penginput</label>
                            <input type="text" class="form-control" id="created_by" name="created_by" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="updated_by" class="form-label">Nama Pengedit</label>
                            <input type="text" class="form-control" id="updated_by" name="updated_by" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="print_type" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="print_type" name="print_type" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="print_type_price" class="form-label">Harga Kategori</label>
                            <input type="text" class="form-control mask-money" id="print_type_price" name="print_type_price" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="subtotal" class="form-label">Sub Total</label>
                            <input type="text" class="form-control mask-money" id="subtotal" name="subtotal" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Diskon</label>
                            <input type="text" class="form-control mask-money" id="discount" name="discount" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control mask-money" id="total" name="total" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="date" name="date" readonly>
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
                $('#order_number').val(detail.order_number);
                $('#name').val(detail.name);
                $('#created_by').val(detail.created_by?.name);
                $('#updated_by').val(detail.updated_by?.name);
                $('#customer_name').val(detail.customer.name);
                $('#print_type').val(detail.print_type.name);
                $('#print_type_price').val(detail.print_type.price);
                $('#qty').val(detail.qty);
                $('#subtotal').val(detail.subtotal);
                $('#discount').val(detail.discount);
                $('#total').val(detail.total);
                $('#date').val(moment(detail.date).format('DD-MM-YYYY'));
            })
        })
    </script>
@endpush
