@canany(['print-type.edit', 'print-type.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('print-type.edit')
                <li>
                    <a href="{{ route('print-type.edit', $printType->id) }}" class="dropdown-item">Edit</a>
                </li>
            @endcan
            @can('print-type.delete')
                <li>
                    <form action="{{ route('print-type.destroy', $printType->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
