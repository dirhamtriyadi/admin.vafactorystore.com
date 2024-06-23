@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Role</h1>
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
                            <h3 class="card-title">Data Role</h3>

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
                            <div class="d-flex justify-content-end">
                                @can('role.create')
                                    <a href="{{ route('role.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                                @endcan
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $i => $role)
                                            <tr>
                                                <td>{{ $i + $roles->firstitem() }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class="text-center">
                                                    @canany(['role.edit', 'role.delete'])
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-sm btn-info dropdown-toggle"
                                                                type="button"
                                                                data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                @can('role.edit')
                                                                    <li>
                                                                        <a href="{{ route('role.edit', $role->id) }}" class="dropdown-item">Edit</a>
                                                                    </li>
                                                                @endcan
                                                                @can('role.delete')
                                                                    <li>
                                                                        <form action="{{ route('role.destroy', $role->id) }}" method="post" class="d-inline">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="dropdown-item">Hapus</button>
                                                                        </form>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    @endcanany
                                                    {{-- @can('role.edit')
                                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    @can('role.delete')
                                                        <form action="{{ route('role.destroy', $role->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    @endcan --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $roles->links() }}
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
