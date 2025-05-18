@canany(['role.edit', 'role.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
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
