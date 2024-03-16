<div class="tab-pane fade {{ $role==='admin' ? 'active' : '' }} show" id="{{ $role }}" role="tabpanel" aria-labelledby="{{ $role }}-tab">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>URL</th>
                <th>Icon</th>
                <th>Parent ID</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menuItems->where('role',$role) as $menu)
                @if($menu->parent_id === null)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->nama }}</td>
                        <td>{{ $menu->url }}</td>
                        <td>{{ $menu->icon }}</td>
                        <td>{{ $menu->parent_id ?? 'Parent' }}</td>
                        <td>{{ $menu->role }}</td>
                        <td>
                            <a href="{{ route('adm.menu.edit',[$menu->id]) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('adm.menu.destroy', $menu) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin menghapus menu {{ $menu->nama }}')"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @if ($menu->children()->count() > 0)
                        @foreach ($menu->children as $child )
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>└─ {{  $child->nama }}</td>
                                <td>{{ $child->url }}</td>
                                <td>{{ $child->icon }}</td>
                                <td>{{ $child->parent_id ?? 'Parent' }}</td>
                                <td>{{ $child->role }}</td>
                                <td>
                                    <a href="{{ route('adm.menu.edit',[$child->id]) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                    <form action="{{ route('adm.menu.destroy', $child) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin menghapus menu {{ $child->nama }}')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</div>
