<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use Illuminate\Http\Request;

class TeacherAssignmentsController extends Controller
{
    /**
     * Menampilkan daftar tugas kelas.
     *
     * @return \Illuminate\View\View
     */
    public function index(string $id)
    {
        // Mengambil semua data tugas kelas
        $assignments = Assignments::all();

        $title = 'Dashboard';
        $assignmentsId = $id;

        // Menampilkan view 'assignments.index' dengan data assignments
        return view('teachers.assignments', compact('assignments','title', 'assignmentsId'));
    }
}