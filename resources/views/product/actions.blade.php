<div class="dropdown">
    <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Aksi
    </button>
    <ul class="dropdown-menu">
        @can('product.edit')
            <li>
                <a href="{{ route('product.edit', $product->id) }}" class="dropdown-item">Edit</a>
            </li>
        @endcan
        <li>
            <a href="#" class="dropdown-item btn-show"
                data-image="/images/products/{{ $product->image }}">Gambar</a>
        </li>
        @can('product.delete')
            <li>
                <form action="{{ route('product.destroy', $product->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item">Hapus</button>
                </form>
            </li>
        @endcan
    </ul>
</div>
