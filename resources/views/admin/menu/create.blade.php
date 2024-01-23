@extends('layouts.app-mazer')

@section('content')
    <div>
        <h2>Create Menu Item</h2>
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
            <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                {!! Form::label('parent_id', 'Parent id') !!}
                {!! Form::select('parent_id', $menuItems->whereNull('parent_id')->pluck('nama','id'), null, ['id' => 'parent_id', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('parent_id') }}</small>
            </div>
            </div>
            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                {!! Form::label('role', 'Role') !!}
                {!! Form::select('role', ['admin'=>'admin','guru'=>'guru','bk'=>'bk','walikelas'=>'walikelas'], null, ['id' => 'role', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('role') }}</small>
            </div>
            <button type="submit" class="btn btn-success">Buat</button>
        </form>
    </div>
@endsection
