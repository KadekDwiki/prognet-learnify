<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherAssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Menampilkan daftar tugas kelas.
     *
     * @return \Illuminate\View\View
     */
    public function index(string $classId)
    {

        $title = 'Tugas Kelas';
        $classId = $classId;
        $assignments = Assignments::where('class_id', $classId)->get();

        // Menampilkan view 'assignments.index' dengan data assignments
        return view('teachers.assignments-teacher.assignments', compact('assignments', 'title', 'classId'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $classId)
    {
        //membuat tugas kelas
        $title = "Buat Tugas";
        $classId = $classId;

        return view('teachers.assignments-teacher.create-assignments', compact('title','classId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan tugas
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tugaskan_ke' => 'required|string',
            'poin' => 'required|integer',
            'tenggat' => 'nullable|date',
            'topik' => 'nullable|string',
        ]);
    
        Assignments::create($validated);
    
        return redirect()->route('create-assignments.store')->with('success', 'Tugas berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $classId)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $classId)
    {
        // Cari tugas berdasarkan ID
        $assignments = Assignments::findOrFail($classId);
        $title = 'Edit Tugas';

        return view('teachers.assignments-teacher.create-assignments', compact('assignments', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $classId)
    {
        //Memperbarui tugas
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tugaskan_ke' => 'required|string',
            'poin' => 'required|integer',
            'tenggat' => 'nullable|date',
            'topik' => 'nullable|string',
        ]);
    
        $assignments = Assignments::findOrFail($classId);
        $assignments->update($validated);
    
        return redirect()->route('create-assignments.update', $classId)->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
