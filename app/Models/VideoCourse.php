<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    use HasFactory;

    protected $table = 'video_courses';
    protected $fillable = ['course_id','video'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
