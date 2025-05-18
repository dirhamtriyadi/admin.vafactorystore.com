@canany(['makloon-transaction.edit', 'makloon-transaction.destroy'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('makloon-transaction.edit')
                <li>
                    <a class="dropdown-item" href="{{ route('makloon-transaction.edit', $makloonTransaction->id) }}">Edit</a>
                </li>
            @endcan
            @can('makloon-transaction.delete')
                <li>
                    <form action="{{ route('makloon-transaction.destroy', $makloonTransaction->id) }}" method="post"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
