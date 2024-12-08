<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Classes;
use App\Models\Assignments;
use App\Models\AssignmentsSubmissions;
use Illuminate\Http\Request;
use App\Models\ClassStudents;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $hour = $now->hour;

        if ($hour >= 5 && $hour < 12) {
            $greeting = "Pagi";
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = "Siang";
        } else {
            $greeting = "Malam";
        }

        $title = 'Dashboard';
        $userId = Auth::id();
        $classes = ClassStudents::join('classes', 'class_students.class_id', '=', 'classes.id')
            ->join('users', 'classes.teacher_id', '=', 'users.id')
            ->select('classes.id as class_id', 'classes.name as class_name', 'users.name as teacher_name')
            ->where('class_students.student_id', $userId)
            ->get();

        $allAssignments = Assignments::join('classes', 'assignments.class_id', '=', 'classes.id')
            ->join('class_students', 'classes.id', '=', 'class_students.class_id')
            ->where('class_students.student_id', $userId)
            ->select('assignments.*')
            ->count();

        $completedAssignments = AssignmentsSubmissions::where('student_id', $userId)
            ->count();

        $pendingAssignments = ($allAssignments - $completedAssignments);

        $classCount = ClassStudents::where('student_id', $userId)
            ->distinct('class_id')
            ->count();

        return view('dashboard.index', compact('title', 'greeting', 'classes', 'pendingAssignments', 'completedAssignments', 'classCount'));
    }
}
