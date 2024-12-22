<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudents extends Model
{
    /** @use HasFactory<\Database\Factories\ClassStudentsFactory> */
    use HasFactory;

    protected $fillable = [
        'class_id',
        'student_id',
        'joined_at'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}