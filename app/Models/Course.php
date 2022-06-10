<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table="courses";
    protected $fillable=['title','slug','subject','level_id','price_id','link','description','image'];

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

    public function detailcourse()
    {
        return $this->hasMany(DetailCourse::class);
    }
}


