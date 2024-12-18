<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    /** @use HasFactory<\Database\Factories\LessonsFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'file_url',
        'class_id'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    
    public static function uploadFile($file)
    {
        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            return $file->storeAs('lessons/files', $fileName, 'public');
        }
        return null;
    }
}