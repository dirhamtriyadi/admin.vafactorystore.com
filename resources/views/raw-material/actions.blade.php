@canany(['raw-material.edit', 'raw-material.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('raw-material.edit')
                <li>
                    <a href="{{ route('raw-material.edit', $rawMaterial->id) }}" class="dropdown-item">Edit</a>
                </li>
            @endcan
            @can('raw-material.delete')
                <li>
                    <form action="{{ route('raw-material.destroy', $rawMaterial->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
