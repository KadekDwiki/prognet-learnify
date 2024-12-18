<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\ClassStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignmentsSubmissions;

class TeacherClassesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kelas Guru";
        $userId = Auth::id();
        $classes = Classes::join('users', 'classes.teacher_id', '=', 'users.id')
            ->select('classes.id as class_id', 'classes.name as class_name', 'users.name as teacher_name')
            ->where('classes.teacher_id', $userId)
            ->get();

        return view('teachers.classes-teachers', compact('title', 'classes'));
    }

    public function showMembers($id)
    {
        $title = "Daftar Anggota Kelas";
        $lessonId = $id;

        $class = Classes::findOrFail($id);

        // $teachers = $class->teacher();
        $teacherName = $class->teacher->name;
        $students = $class->students()->paginate(10);
        // dd($students);


        return view('teachers.members-teachers', compact('title', 'lessonId', 'students', 'class','teacherName'));
    }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($student_id)
    {
     // Cari siswa di tabel class_students atau relasi lain yang sesuai
    $classStudent = ClassStudents::where('student_id', $student_id)->first();

    if ($classStudent) {
        // Hapus siswa dari kelas
        $classStudent->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus dari kelas.');
    }

    return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
    }

    public function showGrade(string $classId, string $assignmentId)
    {
       
        $title = "Nilai";
        $students = ClassStudents::where('class_id', $classId)->paginate(10);

        $grades = [];
        foreach ($students as $student) {
            $grades[$student->id] = AssignmentsSubmissions::where('student_id', $student->id)
                                                          ->where('assignment_id', $assignmentId)
                                                          ->first();
        }
    
        return view('teachers.grades', compact('title', 'students', 'grades', 'classId', 'assignmentId'));
    }
    
}