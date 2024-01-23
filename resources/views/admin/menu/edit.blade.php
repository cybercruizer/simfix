@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit Menu Item</h2>
        <form action="{{ route('adm.menu.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}" required>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" value="{{ $menu->url }}">
            </div>
            <div class="form-group">
                <label for="parent_id">Parent ID</label>
                <input type="number" name="parent_id" class="form-control" value="{{ $menu->parent_id }}">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" class="form-control" value="{{ $menu->role }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
