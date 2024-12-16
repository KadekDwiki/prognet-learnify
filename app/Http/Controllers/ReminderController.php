<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignments;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index(Request $request)
    {
        // Set default title untuk halaman
        $title = 'Reminder';

        // Ambil tanggal yang dipilih dari input filter
        $selectedDate = $request->input('date');

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil ID kelas yang diikuti siswa melalui relasi many-to-many
        $classIds = $user->classes()->pluck('classes.id'); // Ambil id dari tabel classes

        // Query untuk mendapatkan tugas berdasarkan kelas yang diikuti siswa dan filter tanggal
        $assignments = Assignments::whereIn('class_id', $classIds) // Filter berdasarkan kelas siswa
            ->when($selectedDate, function ($query, $selectedDate) {
                // Filter berdasarkan tanggal jika dipilih
                return $query->whereDate('due_date', $selectedDate);
            })
            ->with('classes') // Relasi untuk mendapatkan data kelas dari tugas
            ->get();

        // Return view dengan data tugas yang difilter
        return view('students.reminder.reminder', [
            'title' => $title,
            'assignments' => $assignments,
            'selectedDate' => $selectedDate
        ]);
    }
}
