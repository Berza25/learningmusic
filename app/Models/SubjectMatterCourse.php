<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMatterCourse extends Model
{
    use HasFactory;
    protected $table = 'subject_matter_courses';
    protected $fillable = ['course_id', 'subject_matter'];
}
