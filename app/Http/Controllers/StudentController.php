<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::with('classroom')->select('student_id','student_name','student_number','class_id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Student $student){
                    $actionBtn = '<a href="/details" class="edit btn btn-success btn-sm">Edit</a>';
                    return $actionBtn;
                })
                ->addColumn('classroom', function(Student $student){
                    return $student->classroom->class_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('students');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students-edit', compact('student'));
    }
    public function details($id)
    {
        $student = Student::findOrFail($id);
        return view('students-details', compact('student'));
    }

}
