<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lessons;
use Illuminate\Http\Request;

class TeacherLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $title = "Materi Guru"; 
        $lessonId = $id;
        $class = Classes::with('lessons')->find($id);
        $lessons = $class->lessons;
        // dd($class);    
        return view('teachers.lessons-teacher.lessons', compact('title', 'lessons','lessonId'));
    }

    public function show(string $classId, string $lessonId)
    {
        $title = "Detail Materi";
        $classId = $classId;
        $lessonId = $lessonId;
        $topics = Lessons::find($lessonId);

        return view('teachers.lessons-teacher.lessons-detail', compact('title', 'topics', 'classId', 'lessonId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $classId)
    {
        $title = "Tambah Materi";
        $classId = $classId;

        return view('teachers.lessons-teacher.lessons-add', compact('title', 'classId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'files.*' => 'nullable|mimes:jpg,png,pdf|max:2048',
        ]);

        // Simpan data tugas
        $assignment = Lessons::create([
            'title' => $request->input('title'),
        ]);

        // Simpan file jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('assignments', 'public');
                $assignment->files()->create(['path' => $path]);
            }
        }

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dibuat!');
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
    public function destroy($id)
    {
        $lesson = Lessons::findOrFail($id);
        $lesson->delete();
    
        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}