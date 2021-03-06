<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table="lessons";
    protected $fillable=['course_id', 'title', 'slug', 'embed_id', 'subject_matter'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessonstudent()
    {
        return $this->hasMany(LessonStudent::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class,'lesson_students')->withTimestamps();
    }
}
