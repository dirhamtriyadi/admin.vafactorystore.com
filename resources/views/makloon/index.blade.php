@extends('templates.main')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                                        <a href="{{ route('makloon.create') }}" class="btn btn-primary mb-3"><i
                                                class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="table">
                                    <thead>
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
                                    {{-- <tbody>
                                        @forelse ($makloons as $i => $makloon)
                                            <tr>
                                                <td>{{ $i + $makloons->firstitem() }}</td>
                                                <td>{{ $makloon->makloon_number }}</td>
                                                <td>{{ isset($makloon->createdBy->name) ? $makloon->createdBy->name : '' }}
                                                </td>
                                                <td>{{ $makloon->customer->name }}</td>
                                                <td>{{ $makloon->name }}</td>
                                                <td>{{ $makloon->description }}</td>
                                                <td>{{ $makloon->date }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Aksi
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @can('makloon.edit')
                                                                <li>
                                                                    <a href="{{ route('makloon.edit', $makloon->id) }}"
                                                                        class="dropdown-item">Edit</a>
                                                                </li>
                                                            @endcan
                                                            <li>
                                                                <a href="#" class="dropdown-item btn-show"
                                                                    data-detail="{{ $makloon }}">Detail</a>
                                                            </li>
                                                            @can('makloon.delete')
                                                                <li>
                                                                    <form action="{{ route('makloon.destroy', $makloon->id) }}"
                                                                        method="post" class="d-inline">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="dropdown-item">Hapus</button>
                                                                    </form>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody> --}}
                                </table>
                                {{-- {!! $makloons->links() !!} --}}
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            const table = $('#table').DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ],
                ajax: {
                    url: "{{ route('makloon.get-makloon-data-table') }}",
                },
                autoWidth: false,
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false
                }],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'makloon_number',
                    },
                    {
                        data: 'created_by',
                    },
                    {
                        data: 'customer',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'date',
                    },
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                language: {
                    emptyTable: "Tidak ada data yang tersedia di tabel ini",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                },
                dom: `<<"d-flex justify-content-between"lf>Brt<"d-flex justify-content-between"ip>>`,
            })
        });
    </script>
    <script>
        $(function() {
            $('#table').on('click', '.btn-show', function() {
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
                    tr.append($('<td>').text(item.size));
                    tr.append($('<td>').text(item.unit));
                    tr.append($('<td>').text(item.qty));
                    tr.append($('<td>').text('Rp. ' + item.price.toLocaleString('id-ID')));
                    tr.append($('<td>').text('Rp. ' + (item.qty * item.price).toLocaleString(
                        'id-ID')));
                    tableItemMakloonBody.append(tr);
                });

                let tableItemMakloonFoot = tableItemMakloon.find('tfoot');
                tableItemMakloonFoot.empty();
                let trFoot = $('<tr>');
                trFoot.append($('<td>').text('Total').attr({
                    'colspan': 5,
                    'class': 'text-bold text-center',
                }));;
                trFoot.append($('<td>').text(qty).attr('class', 'text-bold'));
                trFoot.append($('<td>').text('Rp. ' + price.toLocaleString('id-ID')).attr('class',
                    'text-bold'));
                trFoot.append($('<td>').text('Rp. ' + totalPrice.toLocaleString('id-ID')).attr('class',
                    'text-bold'));
                tableItemMakloonFoot.append(trFoot);

                $('.btn-print').attr('href', `{{ route('makloon.print') }}?id=${detail.id}`);
            })
        })
    </script>
@endpush
