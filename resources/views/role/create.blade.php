@extends('templates.main')

@push('styles')
@endpush

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Role</h1>
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
                            <h3 class="card-title">Tambah Role</h3>

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
                                <a href="{{ route('role.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama *</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}">
                                </div>

                                {{-- <div class="form-group mb-3">
                                    <label for="permissions" class="form-label">Permission *</label>
                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="mb-3 card p-3">
                                    <label for="permissions" class="form-label">Permission *</label>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            @php
                                                $group = explode('.', $permission->name)[0];
                                            @endphp
                                            @if ($loop->first || $group != explode('.', $permissions[$loop->index - 1]->name)[0])
                                                <div class="col-md-3 p-3">
                                                    <div
                                                        class="form-group
                                                        {{ $loop->first ? 'mb-3' : '' }}">
                                                        <label for="{{ $group }}-select-all"
                                                            class="form-label">{{ ucfirst($group) }}</label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input select-all"
                                                                id="{{ $group }}-select-all">
                                                            <label class="custom-control-label"
                                                                for="{{ $group }}-select-all">Select All</label>
                                                        </div>

                                                        @foreach ($permissions as $permission)
                                                            @if (explode('.', $permission->name)[0] == $group)
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input {{ $group }}"
                                                                        id="{{ $permission->name }}" name="permissions[]"
                                                                        value="{{ $permission->name }}">
                                                                    <label class="custom-control-label"
                                                                        for="{{ $permission->name }}">{{ explode('.', $permission->name)[1] }}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
    <script>
        $(document).ready(function() {
            // Handle Select All checkboxes
            $(".select-all").click(function() {
                var groupClass = $(this).attr("id").replace("-select-all",
                    ""); // Get the base class for the group
                $("." + groupClass).prop("checked", $(this).prop("checked"));
            });

            // If any checkbox within the group is unchecked, uncheck the "Select All" checkbox
            $(".custom-control-input").not(".select-all").click(function() {
                var groupClass = $(this).attr("class").split(' ')[1]; // Get the group class
                var groupCheckboxes = $("." + groupClass);
                var allChecked = groupCheckboxes.length === groupCheckboxes.filter(":checked").length;
                $("#" + groupClass + "-select-all").prop("checked", allChecked);
            });
        });
    </script>
@endpush
