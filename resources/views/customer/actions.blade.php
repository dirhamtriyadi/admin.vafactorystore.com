@canany(['customer.edit', 'customer.destroy'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('customer.edit')
                <li>
                    <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">Edit</a>
                </li>
            @endcan
            @can('customer.delete')
                <li>
                    <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
