@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data User</h1>
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
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data User</h3>

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
                            <div class="d-flex flex-column justify-content-end">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah User</a>
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('user.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Barang" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('user.index') }}" method="GET">
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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $i => $user)
                                            <tr>
                                                <td>{{ $i + $users->firstitem() }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $item)
                                                        {{ $item->name }}
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
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
