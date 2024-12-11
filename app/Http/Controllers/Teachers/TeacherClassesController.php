<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherClassesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Kelas Guru";
        $userId = Auth::id();
        $classes = Classes::join('users', 'classes.teacher_id', '=', 'users.id')
            ->select('classes.id as class_id', 'classes.name as class_name', 'users.name as teacher_name')
            ->where('classes.teacher_id', $userId)
            ->get();

        return view('teachers.classes-teachers', compact('title', 'classes'));
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