@extends('layouts.app-mazer')
@section('content')
    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Kelas : {{ $kelas->class_name }}</h4>
                </div>
                <div class="card-body">
                    <!-- Konten -->
                    <form method="POST" action="{{ route($prefix.'.presensi.store', $kelas->class_id) }}" class="form-horizontal">
                    @csrf
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
                    <div class="col-md-5">
                        <label for="tgl">Pilih Tangal</label>
                        <input type="date" class="form-control mb-3" name="tanggal" id="tgl" value="{{ date('Y-m-d') }}">
                    </div><br>
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th >Nama</th>
                                <th >Presensi</th>
                                <th >Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $siswa)
                            <tr>
                                <input type="hidden" name="siswa[{{ $siswa->student_id }}][id]" value="{{$siswa->student_id}}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $siswa->student_name }}</td>
                                <td>
                                    <SELECt name="siswa[{{ $siswa->student_id }}][status]" class="form-select">
                                        <option value="H" {{ old('siswa.' . $siswa->student_id . '.status') === 'H' ? 'selected' : '' }}>Hadir</option>
                                        <option value="S" {{ old('siswa.' . $siswa->student_id . '.status') === 'S' ? 'selected' : '' }}>Sakit</option>
                                        <option value="I" {{ old('siswa.' . $siswa->student_id . '.status') === 'I' ? 'selected' : '' }}>Ijin</option>
                                        <option value="A" {{ old('siswa.' . $siswa->student_id . '.status') === 'A' ? 'selected' : '' }}>Alpha</option>
                                        <option value="T" {{ old('siswa.' . $siswa->student_id . '.status') === 'T' ? 'selected' : '' }}>Terlambat</option>
                                    </SELECt>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="siswa[{{ $siswa->student_id }}][keterangan]" value="{{ old('siswa.' . $siswa->student_id . '.keterangan') }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group pull-right">
                        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}&nbsp;&nbsp;
                        {!! Form::submit('Kirim', ['class' => 'btn btn-success']) !!}
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
