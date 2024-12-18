<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Lessons;
use App\Models\Assignments;
use App\Models\AssignmentsSubmissions;
use Illuminate\Http\Request;
use App\Models\ClassStudents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

    public function joinClass(Request $request)
    {
        // Validasi input
        $request->validate([
            'classCode' => 'required|string|max:255',
        ]);

        // Ambil kode kelas dari input
        $classCode = $request->input('classCode');
        $user = auth()->user();

        // Cari kelas berdasarkan token (kode kelas)
        $class = Classes::where('token', $classCode)->first();

        // Jika kelas tidak ditemukan
        if (!$class) {
            return redirect()->back()->with('error', 'Kode kelas tidak valid.');
        }

        // Cek apakah siswa sudah tergabung di kelas ini
        $existingStudent = DB::table('class_students')
            ->where('class_id', $class->id)
            ->where('student_id', $user->id)
            ->first();

        // Jika sudah tergabung, tampilkan pesan error
        if ($existingStudent) {
            return redirect()->back()->with('error', 'Anda sudah tergabung di kelas ini.');
        }

        // Masukkan siswa ke dalam kelas
        DB::table('class_students')->insert([
            'class_id' => $class->id,
            'student_id' => $user->id,
            'joined_at' => now(),
        ]);

        // Berikan pesan sukses
        return redirect()->route('classes')->with('success', 'Anda berhasil bergabung ke kelas!');
    }

    /**
     * Display the specified resource.
     */
    public function lessons(string $id)
    {
        $title = "Daftar Topik";
        $lessonId = $id;
        $classes = Classes::with('lessons')->find($id);
        $lessons = $classes->lessons;

        return view('students.lessons.lessons_class', compact('title', 'lessons', 'lessonId'));
    }

    public function showMembers($id)
    {
        $title = "Daftar Anggota Kelas";
        $lessonId = $id;

        $class = Classes::findOrFail($id);

        $teacher = $class->teacher;
        $students = $class->students()->paginate(10);

        return view('students.members', compact('title', 'lessonId', 'students', 'class', 'teacher'));
    }

    public function lessonDetail(string $classId, string $lessonId)
    {
        $title = "Detail Topik";
        $classId = $classId;
        $lessonId = $lessonId;
        $topics = Lessons::find($lessonId);

        return view('students.lessons.lesson_detail', compact('title', 'topics', 'classId', 'lessonId'));
    }

    public function assignments(string $id)
    {
        $title = "Daftar Tugas";
        $lessonId = $id;

        $assignments = Assignments::where('assignments.class_id', $id)
            ->leftJoin('assignments_submissions', function ($join) {
                $join->on('assignments.id', '=', 'assignments_submissions.assignment_id')
                    ->where('assignments_submissions.student_id', auth()->id());
            })
            ->select(
                'assignments.id',
                'assignments.class_id',
                'assignments.title',
                'assignments.due_date',
                'assignments.description',
                'assignments_submissions.grade'
            )
            ->get();

        // dd($assignments);

        return view('students.assignments.assignments_class', compact('title', 'assignments', 'lessonId'));
    }

    public function assignmentDetail(string $classId, string $assignmentId)
    {
        $title = "Detail Topik";
        $classId = $classId;
        $assignmentId = $assignmentId;
        $assignment = Assignments::find($assignmentId);

        $submission = AssignmentsSubmissions::where('assignment_id', $assignmentId)
            ->where('student_id', Auth::user()->id)
            ->first();

        return view('students.assignments.assignment_detail', compact('title', 'assignment', 'classId', 'assignmentId', 'submission'));
    }

    public function handleStudentSubmission(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:1048',
        ]);

        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/student-submissions', $originalFileName, 'public');

        $validate = [
            'file_url' => $filePath,
            'assignment_id' => $request->assignment_id,
            'student_id' => Auth::user()->id,
            'submitted_at' => now()
        ];

        // Create a new submission record
        AssignmentsSubmissions::create($validate);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Tugas berhasil di serahkan');
    }

    public function setting(string $id)
    {
        $title = "Setting";
        $lessonId = $id;
        $user = Auth::user();

        return view('profile.profile', compact('title', 'lessonId', 'user'));
    }

    public function leaveClass(Request $request, $classId)
    {
        $user = auth()->user();

        DB::table('class_students')
            ->where('class_id', $classId)
            ->where('student_id', $user->id)
            ->delete();

        return redirect()->route('classes')->with('success', 'Anda telah keluar dari kelas.');
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
