<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentsFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'topic',
        'file_url',
        'due_date',
        'class_id'
    ];

    /**
     * Relasi dengan tabel Class.
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id'); // Relasi ke model Classroom
    }
}