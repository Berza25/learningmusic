<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCourse extends Model
{
    use HasFactory;

    protected $table = 'detail_courses';
    protected $fillable = ['course_id', 'fmateri', 'video'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
