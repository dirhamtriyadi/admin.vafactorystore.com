@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Maklun</h1>
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
                            <h3 class="card-title">List Data Maklun</h3>

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
                                    @can('makloon.create')
                                        <a href="{{ route('makloon.create') }}" class="btn btn-primary mb-3">Tambah Maklun</a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('makloon.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Maklun" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('makloon.index') }}" method="GET">
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
                                            <th>Nomor Maklun</th>
                                            <th>Nama Penginput</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Maklun</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($makloons as $i => $makloon)
                                            <tr>
                                                <td>{{ $i + $makloons->firstitem() }}</td>
                                                <td>{{ $makloon->makloon_number }}</td>
                                                <td>{{ isset($makloon->createdBy->name) ? $makloon->createdBy->name : '' }}</td>
                                                <td>{{ $makloon->customer->name }}</td>
                                                <td>{{ $makloon->name }}</td>
                                                <td>{{ $makloon->description }}</td>
                                                <td>{{ $makloon->date }}</td>
                                                <td>
                                                    @can('makloon.edit')
                                                        <a href="{{ route('makloon.edit', $makloon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    <a href="#" class="btn btn-info btn-sm btn-show" data-detail="{{ $makloon }}">Detail</a>
                                                    @can('makloon.delete')
                                                        <form action="{{ route('makloon.destroy', $makloon->id) }}" method="post" class="d-inline">
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
                                {!! $makloons->links() !!}
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
                        <div class="table-responsive">
                            <table id="table-details" class="table table-bordered table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Ukuran</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> --}}
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a class="btn btn-primary btn-print">Print</a>
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
                $('#modal-lg .modal-body tbody').empty();
                $('#modal-lg .modal-title').text(`Detail Maklun ${detail.makloon_number}`);
                let tableItemMakloon = $('#table-details');
                let tableItemMakloonBody = tableItemMakloon.find('tbody');
                tableItemMakloonBody.empty();

                let qty = 0;
                let price = 0;
                let totalPrice = 0;


                detail.details.forEach((item, index) => {
                    qty += item.qty;
                    price += item.price;
                    totalPrice += item.qty * item.price;
                    let tr = $('<tr>');
                    tr.append($('<td>').text(index + 1));
                    tr.append($('<td>').text(item.name));
                    tr.append($('<td>').text(item.code));
                    tr.append($('<td>').text(item.qty));
                    tr.append($('<td>').text('Rp. ' + item.price.toLocaleString('id-ID')));
                    tr.append($('<td>').text('Rp. ' + (item.qty * item.price).toLocaleString('id-ID')));
                    tr.append($('<td>').text(item.size));
                    tr.append($('<td>').text(item.unit));
                    tableItemMakloonBody.append(tr);
                });

                let tableItemMakloonFoot = tableItemMakloon.find('tfoot');
                tableItemMakloonFoot.empty();
                let trFoot = $('<tr>');
                trFoot.append($('<td>').text('Total').attr({
                    'colspan': 3,
                    'class': 'text-bold text-center',
                }));
                trFoot.append($('<td>').text(qty).attr('class', 'text-bold'));
                trFoot.append($('<td>').text('Rp. ' + price.toLocaleString('id-ID')).attr('class', 'text-bold'));
                trFoot.append($('<td>').text('Rp. ' + totalPrice.toLocaleString('id-ID')).attr('class', 'text-bold'));
                trFoot.append($('<td>').text('').attr('colspan', 2));
                tableItemMakloonFoot.append(trFoot);

                $('.btn-print').attr('href', `{{ route('makloon.print') }}?id=${detail.id}`);
            })

        })
    </script>
@endpush
