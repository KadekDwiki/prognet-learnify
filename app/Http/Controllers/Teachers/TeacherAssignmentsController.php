<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignmentsSubmissions;
use App\Models\Lessons;

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
        $topic = Lessons::select('title as topic')
            ->where('class_id', $classId)
            ->get();

        return view('teachers.assignments-teacher.create-assignments', compact('title', 'classId', 'topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan tugas
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'topic' => 'required|string',
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:1048',
        ]);

        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/teachers-submissions', $originalFileName, 'public');

        $validated['file_url'] = $filePath;
        $validated['class_id'] = $request->class_id;

        // dd($validated);
        Assignments::create($validated);

        return redirect()->route('assignments.index', $request->class_id)->with('success', 'Tugas berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function showSubmissionsByAssignmentId(string $classId, string $assignmentId)
    {
        $title = 'Tugas Siswa';
        $classId = $classId;
        $studentsSubmissions = AssignmentsSubmissions::join('users', 'assignments_submissions.student_id', '=', 'users.id')
            ->select('assignments_submissions.id as id', 'assignments_submissions.assignment_id', 'users.name', 'assignments_submissions.file_url', 'assignments_submissions.grade')
            ->where('assignment_id', '=', $assignmentId)->get();
        // dd($studentsSubmissions);
        return view('teachers.assignments-teacher.assignments-grade', compact('title', 'classId', 'studentsSubmissions'));
    }

    public function updateSubmissionGrade(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        $submissionId = $request->submission_id;

        $assignments = AssignmentsSubmissions::find($submissionId);
        $assignments->update($validated);

        return redirect()->back()->with('success', 'Tugas berhasil Dinilai!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $classId)
    {
        // Cari tugas berdasarkan ID
        $assignments = Assignments::findOrFail($classId);
        $classId = $classId;
        $title = 'Edit Tugas';
        $topic = Lessons::select('title as topic')
            ->where('class_id', $classId)
            ->get();

        return view('teachers.assignments-teacher.edit-assignments', compact('assignments','classId', 'topic', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Memperbarui tugas
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'topic' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/teachers-assignments', $originalFileName, 'public');
        $validated['file_url'] = $filePath;
    
        $assignments = Assignments::findOrFail($id);
        $assignments->update($validated);
    
        return redirect()->route('assignments.index', $id)->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignments = Assignments::findOrFail($id);
        $assignments->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }

    public function showDetail(string $classId, string $assignmentId)
    {
        //dd("Class ID: " . $classId, "Assignment ID: " . $assignmentId);

        $topics = Assignments::findOrFail($assignmentId);
        $title = 'Detail Tugas';

        return view('teachers.assignments-teacher.detail-assignments', compact('topics', 'title', 'classId'));
    }

}