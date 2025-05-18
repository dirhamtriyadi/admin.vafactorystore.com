@canany(['user.edit', 'user.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('user.edit')
                <li>
                    <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item">Edit</a>
                </li>
            @endcan
            @can('user.delete')
                <li>
                    <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
