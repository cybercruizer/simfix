@extends('layouts.app-mazer')
@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                    <form action="{{ route('adm.walikelas.store') }}" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%" class="sorting">No</th>
                                    <th>Nama Kelas</th>
                                    <th>Nama Wali Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $k->class_name }}
                                            <input type="hidden" name="wk[{{ $k->class_id }}][class_id]" value="{{ $k->class_id }}">
                                        </td>
                                        <td>
                                            {!! Form::select('wk['.$k->class_id.'][id]', $gurus, null, [
                                                'class' => 'form-select pilih',
                                                'placeholder' => 'Pilih salah satu guru',
                                            ]) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="btn-group pull-right">
                            {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}&nbsp;&nbsp;
                            {!! Form::submit('Kirim', ['class' => 'btn btn-success']) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.pilih').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
