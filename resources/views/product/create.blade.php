@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Barang</h1>
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
                            <h3 class="card-title">Tambah Barang</h3>

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
                                <a href="{{ route('product.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Barang *</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" id="description" name="description"> --}}
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga *</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
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

@endpush
