<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentsSubmissions extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentsSubmissionsFactory> */
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_text',
        'file_url',
        'submitted_at',
        'grade'
    ];
}
