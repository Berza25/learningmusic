<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table="prices";
    protected $fillable=["paid"];

    public function price()
    {
        return $this->hasMany(Course::class);
    }
}
