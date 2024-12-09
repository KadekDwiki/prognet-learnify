<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\ClassStudents;
use App\Models\Lessons;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kelas";
        $userId = Auth::id();
        $classes = ClassStudents::join('classes', 'class_students.class_id', '=', 'classes.id')
            ->join('users', 'classes.teacher_id', '=', 'users.id')
            ->select('classes.id as class_id', 'classes.name as class_name', 'users.name as teacher_name')
            ->where('class_students.student_id', $userId)
            ->get();

        return view('students.classes', compact('title', 'classes'));
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
    public function show(string $id)
    {
        $title = "Daftar Topik";
        $lessonId = $id;
        $class = Classes::with('lessons')->find($id);
        $lessons = $class->lessons;

        return view('students.lessons_class', compact('title', 'lessons', 'lessonId'));
    }

    public function showDetail(string $classId, string $lessonId)
    {
        $title = "Detail Topik";
        $classId = $classId;
        $lessonId = $lessonId;
        $topics = Lessons::find($lessonId);

        return view('students.lesson_detail', compact('title', 'topics', 'classId', 'lessonId'));
    }

    public function setting(string $id)
    {
        $title = "Setting";
        $lessonId = $id;
        $user = auth()->user();

        return view('profile.profile', compact('title', 'lessonId', 'user'));
    }

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
