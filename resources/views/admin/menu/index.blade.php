@extends('layouts.app-mazer')

@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaturan Menu</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMenuModal">Create Menu Item</button>
                    {{--  <a href="{{ route('adm.menu.create') }}" class="btn btn-success">Tambah Menu Item</a> --}}
                    <ul class="nav nav-tabs my-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-controls="home" aria-selected="true">Admin</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#guru" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Guru</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#bk" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">BK</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Route</th>
                                        <th>Icon</th>
                                        <th>Parent ID</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menuItems->where('role','admin') as $menu)
                                        <tr>
                                            <td>{{ $menu->id }}</td>
                                            <td>{{ $menu->parent_id ? '└─ ' : '' }}{{  $menu->nama }}</td>
                                            <td>{{ $menu->url }}</td>
                                            <td>{{ $menu->icon }}</td>
                                            <td>{{ $menu->parent_id }}</td>
                                            <td>{{ $menu->role }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMenuModal{{ $menu->id }}">Edit</button>
                                                <form action="{{ route('adm.menu.destroy', $menu) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin menghapus menu {{ $menu->nama }}')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="guru" role="tabpanel" aria-labelledby="guru-tab">
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
                                    @foreach ($menuItems->where('role','guru') as $menu)
                                        <tr>
                                            <td>{{ $menu->id }}</td>
                                            <td>{{ $menu->parent_id ? '└─ ' : '' }}{{  $menu->nama }}</td>
                                            <td>{{ $menu->url }}</td>
                                            <td>{{ $menu->icon }}</td>
                                            <td>{{ $menu->parent_id }}</td>
                                            <td>{{ $menu->role }}</td>
                                            <td>
                                                <a href="{{ route('adm.menu.edit', $menu) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('adm.menu.destroy', $menu) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean ornare interdum
                                viverra. Sed ut odio velit. Aenean eu diam
                                dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum. Maecenas id
                                sollicitudin ex. Cras in ex vestibulum,
                                posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in cursus sem
                                placerat ut.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Create Menu Modal -->
    <div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMenuModalLabel">Tambah Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for creating menu item goes here -->
                    <form action="{{ route('adm.menu.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" class="form-control">
                        </div>
                        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                            {!! Form::label('icon', 'Icon') !!}
                            {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('icon') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            {!! Form::label('parent_id', 'Parent id') !!}
                            {!! Form::select('parent_id', $menuItems->whereNull('parent_id')->pluck('nama','id'), null, ['id' => 'parent_id', 'class' => 'form-control', 'placeholder'=>'']) !!}
                            <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            {!! Form::label('role', 'Role') !!}
                            {!! Form::select('role', ['admin'=>'admin','guru'=>'guru','bk'=>'bk','walikelas'=>'walikelas'], null, ['id' => 'role', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('role') }}</small>
                        </div>
                        <button type="submit" class="btn btn-success">Buat</button>
                    </form>
                </div>
                <!-- You can add additional modal content or customize as needed -->
            </div>
        </div>
    </div>
    <!-- Edit Menu Modal -->
    <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @include('admin.menu.edit_modal')
            </div>
        </div>
    </div>
    <script>
        // Clear modal form on modal close
        $('#createMenuModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });
        $(document).ready(function () {
        // Load edit menu modal content dynamically
        $('#editMenuModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var menuId = button.data('menu-id');

            // Load content via AJAX
            $.get('/adm/menu/' + menuId + '/edit-modal', function (data) {
                $('#editMenuModal .modal-content').html(data);
            });
        });
    });
    </script>
@endsection
