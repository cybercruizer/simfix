<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Presensi;
use App\Models\Classroom;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class PresensiController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role= Auth::user()->role;
        $userPrefix = getPrefix($role);

        if ($role == 'walikelas'){
            $kelas = Auth::user()->classroom;
            $siswas=$kelas->students;
            //dd($kelas);
        }
        return view('presensi.index',[
            'kelas' => $kelas,
            'siswas'=>$siswas,
            'title'=>'Input Presensi Siswa',
            'prefix'=>$userPrefix,
        ]);
    }
//    public function search(Request $request)
 //   {
 //       $role= Auth::user()->role;
 //       $userPrefix = getPrefix($role);
 //       $kelas = Auth::user()->classroom;
 //       $presensis = Presensi::wheredate('tanggal_presensi',date('Y-m-d',strtotime($request->input('tanggal'))));

//        return view('presensi.edit',[
//            'tanggal'=>$request->input('tanggal'),
//            'kelas' => $kelas,
//            'presensis'=>$presensis,
//            'title'=>'Edit Presensi Siswa',
//            'prefix'=>$userPrefix,
//        ]);
//    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kelasId)
    {
        $kelas=Classroom::findOrFail($kelasId);
        //$request['tanggal'] = Carbon::parse($request['tanggal'])->format('d-m-Y');
        $validatedData= $request->validate([
            'tanggal' => 'required|unique:Presensis,tanggal_presensi,classroom_id' . $kelasId,
            'userId' =>  'required|exists:users,id',
            'siswa.*.id' => 'required',
            'siswa.*.status' => 'required|in:H,S,I,A,T',
            'siswa.*.keterangan' => 'nullable',
        ]);
        // Save attendance data
            foreach ($validatedData['siswa'] as $siswaData) {
                $attendance = new Presensi;
                $attendance->student_id = $siswaData['id'];
                $attendance->user_id = $validatedData['userId'];
                $attendance->classroom_id = $kelas->class_id;
                $attendance->tanggal_presensi = $validatedData['tanggal'];
                $attendance->status = $siswaData['status'];
                $attendance->keterangan = $siswaData['keterangan'];
                $attendance->save();
            }

        // Redirect kembali ke halaman presensi
        return redirect()->route(getPrefix(Auth::user()->role).'.presensi.index')->with('success', 'Presensi tanggal '.$validatedData["tanggal"].' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //$tanggal = $request->input('tanggal');
        $role= Auth::user()->role;
        $userPrefix = getPrefix($role);
        //dd($kelas);

        if ($role == 'walikelas'){
            //dd(Carbon::parse($request->tanggal)->format('Y-m-d'));
            $kelas = Auth::user()->classroom;
            if($request->has('tanggal')){
                $tanggal= Carbon::parse($request->tanggal)->format('Y-m-d');
            } else {
                $tanggal = date("Y-m-d");
            }
            $presensis = Presensi::where([
                ['classroom_id','=',$kelas->class_id],
                ['tanggal_presensi','=',$tanggal ]
            ])->get();
            //dd($presensis);

            return view('presensi.edit',[
                'tanggal'=>$tanggal,
                'kelas' => $kelas,
                'presensis'=>$presensis,
                'title'=>'Edit Presensi Siswa',
                'prefix'=>$userPrefix,
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $kelas = $request->input('kelas');
        $user_id = Auth::user()->id;
        $attendance=Presensi::where('classroom_id',$kelas)->where('tanggal_presensi',$tanggal);
        $validatedData= $request->validate([
            'siswa.*.id' => 'required',
            'siswa.*.status' => 'required|in:H,S,I,A,T',
            'siswa.*.keterangan' => 'nullable',
        ]);
        //simpan ke database
        foreach ($validatedData['siswa'] as $siswaData) {
            $attendance->updateOrCreate(
                ['student_id' => $siswaData['id']],
                [
                    'status' => $siswaData['status'],
                    'keterangan' => $siswaData['keterangan'],
                    'classroom_id' => $kelas,
                    'tanggal_presensi' => $tanggal,
                    'user_id' => $user_id,
                ]
            );
        }
        // Redirect kembali ke halaman presensi
        return redirect()->route(getPrefix(Auth::user()->role).'.presensi.edit',$tanggal)->with('success', 'Presensi tanggal '.$tanggal.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function report2(Request $request): View
    {
        $userPrefix = getPrefix(Auth::user()->role);
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun') ?? now()->format('Y');
        $kelas = Auth::user()->classroom;
        $students = Student::where('class_id',$kelas->class_id)->get();
        $jumlahHari = Carbon::create($tahun,$bulan)->daysInMonth;
        //dd($students);
        $presensiData = [];

        foreach ($students as $student) {
            $presensiData[$student->student_id] = [];
            foreach (range(1, $jumlahHari) as $day) {
                $date = Carbon::create($tahun, $bulan, $day);
                $presensiStatus = Presensi::with('student')->where('student_id', $student->student_id)
                    ->where('tanggal_presensi', $date->format('Y-m-d'))
                    ->value('status');
                $presensiData[$student->student_id][$day] = $presensiStatus ?? '-';
            }
        }
        //dd($presensiData);

        return view('presensi.report', [
            'students' => $students,
            'jumlahHari' => $jumlahHari,
            'kelas' => $kelas,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'presensiData' => $presensiData,
            'title' => 'Laporan Presensi Siswa',
            'prefix' => $userPrefix,
        ]);
    }


    public function report(Request $request)
    {

        $role= Auth::user()->role;
        $userPrefix = getPrefix($role);
        //dd($kelas);

        if ($role == 'walikelas'){
            //dd(Carbon::parse($request->tanggal)->format('Y-m-d'));
            $kelas = Auth::user()->classroom;
            if($request->has('bulan')){
                $bulan = $request->bulan;
            } else {
                $bulan=Carbon::now()->format('m');
            }
            //dd($bulan);
            $students=Student::where('class_id',$kelas->class_id)->get();
            $presensiData=[];
            foreach ($students as $student) {
                $presensi = Presensi::where('student_id', $student->student_id)
                    ->whereMonth('tanggal_presensi', '=', $bulan)
                    ->get();
                //dd($presensi);
                // Organize the attendance data for each student
                $presensiData[$student->student_id] = [];
                foreach ($presensi as $record) {
                    // Assuming 'present' column contains 1 for present and 0 for absent
                    $presensiData[$student->student_id][$record->tanggal_presensi->format('j')] = $record->status;
                }
                //dd($presensiData[$student->student_id]);
            }
            //dd($presensiData);
            return view('presensi.report',[
                //'jmlHari' => Carbon::createFromFormat('Y-m-d',$presensis->tanggal_presensi),
                'students' => $students,
                'kelas' => $kelas,
                'bulan'=>$bulan,
                'presensiData'=>$presensiData,
                'title'=>'Laporan Presensi Siswa',
                'prefix'=>$userPrefix,
            ]);
        }
    }
}
