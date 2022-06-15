<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table="courses";
    protected $fillable=['title','slug','level_id','price_id','description','image'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function mycourse()
    {
        return $this->hasMany(MyCourse::class);
    }

    public function videocourse()
    {
        return $this->hasMany(VideoCourse::class);
    }

    public function subjectmattercourse()
    {
        return $this->hasMany(SubjectMatterCourse::class);
    }
}


