@canany(['payment-method.edit', 'payment-method.delete'])
    <div class="dropdown">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu">
            @can('payment-method.edit')
                <li>
                    <a href="{{ route('payment-method.edit', $paymentMethod->id) }}" class="dropdown-item">Edit</a>
                </li>
            @endcan
            @can('payment-method.delete')
                <li>
                    <form action="{{ route('payment-method.destroy', $paymentMethod->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="dropdown-item">Hapus</button>
                    </form>
                </li>
            @endcan
        </ul>
    </div>
@endcanany
