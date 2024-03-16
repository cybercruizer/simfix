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
                    <form action="{{ route($prefix . '.presensi.report') }}" method="GET" class="d-print-none">
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                <select class="form-select" name="bulan">
                                    <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                                    <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                                    <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                                    <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                                    <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                                    <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                                    <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                                    <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                                </select>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="2023" {{ $tahun == '2023' ? 'selected' : '' }}>2023</option>
                                    <option value="2024" {{ $tahun == '2024' ? 'selected' : '' }}>2024</option>
                                </select>
                                <button class="btn btn-primary" type="submit" id="button-addon2">Tampilkan</button>
                            </div>
                        </div>
                    </form>

                    <br>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="kelas" value="{{ $kelas->class_id }}">
                        <table class="table table-bordered">
                            <thead class="bg-warning">
                                <tr>
                                    <th class="text-center" rowspan="2">NIS</th>
                                    <th class="text-center" rowspan="2">Nama</th>
                                    <th class="text-center" colspan="{{ $jumlahHari }}">Tanggal</th>
                                    <th class="text-center" colspan="4">Jumlah</th>

                                </tr>
                                <tr>
                                    @for ($day = 1; $day <= $jumlahHari; $day++)
                                        <th>{{ $day }}</th>
                                    @endfor
                                    <th>S</th>
                                    <th>I</th>
                                    <th>A</th>
                                    <th>T</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->student_number }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        @php
                                               $s[$student->student_id]=0;
                                               $i[$student->student_id]=0;
                                               $a[$student->student_id]=0;
                                               $t[$student->student_id]=0;
                                        @endphp

                                        @for ($day = 1; $day <= $jumlahHari; $day++)
                                            <td>
                                                {{ $presensiData[$student->student_id][$day] }}
                                            </td>

                                            @switch($presensiData[$student->student_id][$day])
                                                    @case('S')
                                                        @php
                                                            $s[$student->student_id]++;
                                                        @endphp
                                                    @break
                                                    @case('I')
                                                        @php
                                                            $i[$student->student_id]++;
                                                        @endphp
                                                    @break
                                                    @case('A')
                                                        @php
                                                            $a[$student->student_id]++;
                                                        @endphp
                                                    @break
                                                    @case('T')
                                                        @php
                                                            $t[$student->student_id]++;
                                                        @endphp
                                                    @break

                                                    @default

                                                @endswitch
                                        @endfor
                                        <td>{{ $s[$student->student_id] }}</td>
                                        <td>{{ $i[$student->student_id] }}</td>
                                        <td>{{ $a[$student->student_id] }}</td>
                                        <td>{{ $t[$student->student_id] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </section>
@endsection
