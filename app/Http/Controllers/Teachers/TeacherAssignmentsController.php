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
        // 
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
