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
                        <form action="{{ route($prefix.'.presensi.edit') }}" method="GET">
                            <div class="input-group md-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                <input type="date" class="form-control" value="{{ $tanggal }}" placeholder="{{ $tanggal }}" aria-label="Pilih Tanggal" aria-describedby="button-addon2" name="tanggal">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Tampilkan</button>
                            </div>
<!--                            <div class="col-md-5">
                                <label for="tgl">Pilih Tangal</label>
                                <input type="date" class="form-control mb-3" name="tanggal" id="tgl" value="{{ $tanggal }}" placeholder="{{ $tanggal }}">
                                <button type="submit" class="btn btn-success">Tampilkan</button>
                            </div>
-->
                        </form>

                    <br>
                    <form method="POST" action="{{ route($prefix.'.presensi.update') }}" class="form-horizontal">
                        @csrf
                        @method('PUT')
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="kelas" value="{{ $kelas->class_id }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th >Nama</th>
                                <th >Presensi</th>
                                <th >Keterangan</th>
                        </thead>
                        <tbody>
                            @forelse ($presensis as $presensi)
                            <tr>
                                <input type="hidden" name="siswa[{{ $presensi->student_id }}][id]" value="{{$presensi->student_id}}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $presensi->student->student_name }}</td>
                                <td>
                                    <SELECt name="siswa[{{ $presensi->student_id }}][status]" class="form-select">
                                        <option value="H" {{ $presensi->status === 'H' ? 'selected' : '' }}>Hadir</option>
                                        <option value="S" {{ $presensi->status === 'S' ? 'selected' : '' }}>Sakit</option>
                                        <option value="I" {{ $presensi->status === 'I' ? 'selected' : '' }}>Ijin</option>
                                        <option value="A" {{ $presensi->status === 'A' ? 'selected' : '' }}>Alpha</option>
                                        <option value="T" {{ $presensi->status === 'T' ? 'selected' : '' }}>Terlambat</option>
                                    </SELECt>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="siswa[{{ $presensi->student_id }}][keterangan]" value="{{ $presensi->keterangan }}">
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center"><strong>~ Presensi untuk tanggal ini tidak ditemukan ~</strong></td>
                                </tr>
                            @endforelse
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
