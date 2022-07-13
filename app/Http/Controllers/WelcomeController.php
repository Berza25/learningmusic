<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $kelas=Course::get();
        return view('welcome', compact('kelas'));
    }
}
