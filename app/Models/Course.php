<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $table="courses";
    protected $fillable=['title', 'slug', 'level_id', 'price_id', 'description', 'image'];

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
        return $this->belongsToMany(User::class, 'mycourse')->withTimestamps()->withPivot(['rating']);
    }

    public function getRatingAttribute()
    {
        return number_format(DB::table('mycourse')->where('course_id', $this->attributes['id'])->average('rating'), 2);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}


