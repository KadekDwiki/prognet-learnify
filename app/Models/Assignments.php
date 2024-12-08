<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentsFactory> */
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'due_date', 'class_id'
    ];

    // /**
    //  * Relasi dengan tabel Class.
    //  */
    // public function class()
    // {
    //     return $this->belongsTo(Classroom::class, 'class_id'); // Relasi ke model Classroom
    // }
}