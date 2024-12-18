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


    public function submissions()
    {
        return $this->hasMany(AssignmentsSubmissions::class, 'assignment_id'); // Relasi ke model Classroom
    }
    public function assignment()
    {
        return $this->belongsTo(Assignments::class, 'assignment_id', 'id');
    }

    public function scopeFilterByDate($query, $date)
    {
        // Jika $date tidak null, tambahkan kondisi filter
        if ($date) {
            return $query->whereDate('due_date', $date);
        }
        return $query; // Jika tidak ada filter tanggal, kembalikan query apa adanya
    }
}