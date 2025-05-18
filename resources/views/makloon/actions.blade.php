 @canany(['makloon.edit', 'makloon.delete'])
     <div class="dropdown">
         <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
             Aksi
         </button>
         <ul class="dropdown-menu">
             @can('makloon.edit')
                 <li>
                     <a href="{{ route('makloon.edit', $makloon->id) }}" class="dropdown-item">Edit</a>
                 </li>
             @endcan
             <li>
                 <a href="#" class="dropdown-item btn-show" data-detail="{{ $makloon }}">Detail</a>
             </li>
             @can('makloon.delete')
                 <li>
                     <form action="{{ route('makloon.destroy', $makloon->id) }}" method="post" class="d-inline">
                         @csrf
                         @method('delete')
                         <button type="submit" class="dropdown-item">Hapus</button>
                     </form>
                 </li>
             @endcan
         </ul>
     </div>
 @endcanany
