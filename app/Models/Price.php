<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table= 'prices';
    protected $fillable = ['paid', 'status'];

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
