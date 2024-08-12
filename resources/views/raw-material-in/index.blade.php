@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Bahan Baku Masuk</h1>
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
                            <h3 class="card-title">Data Bahan Baku Masuk</h3>

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
                                    @can('raw-material-in.create')
                                        <a href="{{ route('raw-material-in.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('raw-material-in.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Kategori" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('raw-material-in.index') }}" method="GET">
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
                                            <th>Nama Bahan Baku</th>
                                            <th>Qty</th>
                                            <th>Deskripsi</th>
                                            <th>Nama Penginput</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rawMaterialsIn as $item => $i)
                                            <tr>
                                                <td>{{ $item + $rawMaterialsIn->firstitem() }}</td>
                                                <td>{{ $i->rawmaterial->name }}</td>
                                                <td>{{ $i->qty }}</td>
                                                <td>{{ $i->description }}</td>
                                                <td>{{ $i->createdBy->name }}</td>
                                                <td class="text-center">
                                                    @canany(['raw-material-in.edit', 'raw-material-in.delete'])
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-sm btn-info dropdown-toggle"
                                                                type="button"
                                                                data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                @can('raw-material-in.edit')
                                                                    <li>
                                                                        <a href="{{ route('raw-material-in.edit', $i->id) }}" class="dropdown-item">Edit</a>
                                                                    </li>
                                                                @endcan
                                                                @can('raw-material-in.delete')
                                                                    <li>
                                                                        <form action="{{ route('raw-material-in.destroy', $i->id) }}" method="post" class="d-inline">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="dropdown-item">Hapus</button>
                                                                        </form>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    @endcanany
                                                    {{-- @can('raw-material-in.edit')
                                                        <a href="{{ route('raw-material-in.edit', $i->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    @can('raw-material-in.delete')
                                                        <form action="{{ route('raw-material-in.destroy', $i->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $rawMaterialsIn->links() }}
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

@endpush