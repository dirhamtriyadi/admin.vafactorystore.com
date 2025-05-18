@canany(['raw-material-out.edit', 'raw-material-out.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('raw-material-out.edit')
                <li>
                    <a href="{{ route('raw-material-out.edit', $rawMaterialOut->id) }}" class="dropdown-item">Edit</a>
                </li>
            @endcan
            @can('raw-material-out.delete')
                <li>
                    <form action="{{ route('raw-material-out.destroy', $rawMaterialOut->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
