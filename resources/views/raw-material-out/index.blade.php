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
                    <h1>List Data Bahan Baku Keluar</h1>
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
                            <h3 class="card-title">Data Bahan Baku Keluar</h3>

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
                                    @can('raw-material-out.create')
                                        <a href="{{ route('raw-material-out.create') }}" class="btn btn-primary mb-3"><i
                                                class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan Baku</th>
                                            <th>Qty</th>
                                            <th>Deskripsi</th>
                                            <th>Nama Penginput</th>
                                            <th>Tanggal Input</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @forelse ($rawMaterialsOut as $item => $i)
                                            <tr>
                                                <td>{{ $item + $rawMaterialsOut->firstitem() }}</td>
                                                <td>{{ $i->rawmaterial->name }}</td>
                                                <td>{{ $i->qty }}</td>
                                                <td>{{ $i->description }}</td>
                                                <td>{{ $i->createdBy->name }}</td>
                                                <td class="text-center">
                                                    @canany(['raw-material-out.edit', 'raw-material-out.delete'])
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                                data-toggle="dropdown" aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                @can('raw-material-out.edit')
                                                                    <li>
                                                                        <a href="{{ route('raw-material-out.edit', $i->id) }}"
                                                                            class="dropdown-item">Edit</a>
                                                                    </li>
                                                                @endcan
                                                                @can('raw-material-out.delete')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('raw-material-out.destroy', $i->id) }}"
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
                                                    @endcanany
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody> --}}
                                </table>
                                {{-- {{ $rawMaterialsOut->links() }} --}}
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
    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
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
                    url: "{{ route('raw-material-out.get-raw-material-out-data-table') }}",
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
                        data: 'name',
                    },
                    {
                        data: 'qty',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'created_by',
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
@endpush
