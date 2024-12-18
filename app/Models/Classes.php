<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'subject',
        'token',
        'teacher_id'
    ];

    public function lessons()
    {
        return $this->hasMany(Lessons::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_students', 'class_id', 'student_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignments::class, 'class_id');
    }
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); 
    }

    public function delete()
    {
        return $this->belongsTo(ClassStudents::class, 'student_id');
    }
}