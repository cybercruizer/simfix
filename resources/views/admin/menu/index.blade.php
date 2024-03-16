@extends('layouts.app-mazer')

@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaturan Menu</h4>
                    @php
                        //$role=Auth::user()->role;
                        //$roles = ['admin','walikelas','bk','keuangan','guru'];

                    @endphp
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMenuModal">+ Buat menu</button>
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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#walikelas" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Walikelas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#keuangan" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Keuangan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                            @include('components.menutable',['role'=>'admin'])
                            @include('components.menutable',['role'=>'guru'])
                            @include('components.menutable',['role'=>'bk'])
                            @include('components.menutable',['role'=>'walikelas'])
                            @include('components.menutable',['role'=>'keuangan'])
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
