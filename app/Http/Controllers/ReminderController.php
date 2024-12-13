<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Assignments;

class ReminderController extends Controller
{
    public function index()
    {
        $title = 'Reminder';
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        $userId = $user->id;
        $assignments = Assignments::join('classes', 'assignments.class_id', '=', 'classes.id')
        ->join('class_students', 'classes.id', '=', 'class_students.class_id')
        ->join('users as students', 'class_students.student_id', '=', 'students.id') // Profil siswa
        ->join('users as teachers', 'classes.teacher_id', '=', 'teachers.id') // Profil guru
        ->leftJoin('assignments_submissions', function ($join) use ($userId) {
            $join->on('assignments.id', '=', 'assignments_submissions.assignment_id')
                ->where('assignments_submissions.student_id', '=', $userId);
        })
        ->select(
            'classes.id as class_id',
            'classes.name as class_name',
            'teachers.profile_photo_path as teacher_photo', // Profil guru
            'assignments.id as assignment_id',
            'assignments.title as assignment_title',
            'assignments.due_date as assignment_due_date',
            'assignments.description as assignment_description',
            'assignments.file_url as assignment_file'
        )
        ->whereNull('assignments_submissions.id') // Tugas yang belum disubmit
        ->where('class_students.student_id', $userId) // Siswa tertentu
        ->get();
        //dd($assignments);
        return view('students.reminder.reminder', compact('user', 'title', 'assignments')); // Pastikan file `profile.blade.php` ada di folder views/profile
    }
}
