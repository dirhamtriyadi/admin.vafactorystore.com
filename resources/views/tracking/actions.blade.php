 @canany(['tracking.edit', 'tracking.delete'])
     <div class="dropdown">
         <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
             Aksi
         </button>
         <ul class="dropdown-menu">
             @can('tracking.edit')
                 <li>
                     <a href="{{ route('tracking.edit', $tracking->id) }}" class="dropdown-item">Edit</a>
                 </li>
             @endcan
             @can('tracking.delete')
                 <li>
                     <form action="{{ route('tracking.destroy', $tracking->id) }}" method="post" class="d-inline">
                         @csrf
                         @method('delete')
                         <button type="submit" class="dropdown-item">Hapus</button>
                     </form>
                 </li>
             @endcan
         </ul>
     </div>
 @endcanany
