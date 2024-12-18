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
        'class_id'    => 'required|integer', // Validasi class_id
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'files.*'     => 'nullable|file|mimes:jpg,png,pdf|max:2048',
    ]);

    // Proses file jika ada
    $fileUrl = null;
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileUrl = $file->storeAs('lessons/files', $fileName, 'public');
        }
    }

    // Simpan data lesson
    Lessons::create([
        'class_id' => $request->class_id, // Ambil class_id dari request
        'title'    => $request->title,
        'content'  => $request->description,
        'file_url' => $fileUrl,
    ]);

    return redirect()->route('classes.lessons-teachers', $request->class_id)->with('success', 'Materi berhasil diunggah!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lesson = Lessons::findOrFail($id);
        $title = "Edit Materi";
        $classId = $lesson->class_id;
    
        return view('teachers.lessons-teacher.lessons-add', compact('lesson', 'title', 'classId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lesson = Lessons::findOrFail($id);
    
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'files.*'     => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);
    
        // Proses file jika ada
        if ($request->hasFile('files')) {
            $fileUrl = null;
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $fileUrl = $file->storeAs('lessons/files', $fileName, 'public');
            }
            $lesson->file_url = $fileUrl;
        }
    
        // Update data lesson
        $lesson->update([
            'title'    => $request->title,
            'content'  => $request->description,
        ]);
    
        return redirect()->route('classes.lessons-teachers', $lesson->class_id)->with('success', 'Materi berhasil diperbarui!');
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