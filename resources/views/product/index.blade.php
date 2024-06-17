@extends('templates.main')

@push('styles')

@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Barang</h1>
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
                            <h3 class="card-title">Data Barang</h3>

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
                                    @can('product.create')
                                        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-col flex-wrap justify-content-between">
                                    <div class="mb-3">
                                        <form action="{{ route('product.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Cari Barang" value="{{ $search }}">
                                                <input type="submit" value="Cari" class="btn btn-primary ml-3">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mb-3">
                                        <form action="{{ route('product.index') }}" method="GET">
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
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $i => $product)
                                            <tr>
                                                <td>{{ $i + $products->firstitem() }}</td>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>@money($product->price)</td>
                                                <td>
                                                    @can('product.edit')
                                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                    <a href="#" class="btn btn-info btn-sm btn-show" data-image="/images/products/{{ $product->image }}">Gambar</a>
                                                    {{-- <a href="#" class="btn btn-info btn-sm btn-show" data-image="/storage/images/products/{{ $product->image }}">Gambar</a> --}}
                                                    @can('product.delete')
                                                        <form action="{{ route('product.destroy', $product->id) }}" method="post" class="d-inline">
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
                                {{ $products->links() }}
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
                            <img src="" alt="product" id="image" width="100%">
                        {{-- <p>One fine body…</p> --}}
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.btn-show').on('click', function () {
                $('#modal-lg').modal('show');
                $('#image').attr('src', $(this).data('image'));
            })
        })
    </script>
@endpush
