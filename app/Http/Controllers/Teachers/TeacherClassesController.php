<?php

namespace App\Http\Controllers\Teachers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Models\ClassStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignmentsSubmissions;
use Illuminate\Support\Str;

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
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500'
        ]);

        // Simpan data ke database
        $validated['teacher_id'] = Auth::id();
        $validated['token'] = Str::random(6);

        Classes::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Kelas berhasil dibuat.');
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

    public function showGrade(string $classId)
    {
        $title = "Daftar Nilai";

        // Ambil semua tugas untuk class_id tertentu
        $assignments = Assignments::where('class_id', $classId)->get();

        // Ambil semua siswa beserta nilai mereka untuk tugas di kelas tersebut, dengan pagination
        $students = User::whereHas('classStudents', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->with(['assignmentsSubmissions' => function ($query) use ($assignments) {
                $query->whereIn('assignment_id', $assignments->pluck('id'));
            }])
            ->paginate(10); 

        return view('teachers.grades', compact('title', 'students', 'assignments', 'classId'));
    }
    
    
    
    
}