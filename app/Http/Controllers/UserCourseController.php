<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{
    public function index()
    {
        $kelas=Course::get();
        return view('user.course.index', compact('kelas'));
    }
    public function show($slug)
    {
        $data=Course::with('price', 'level')->where('slug', $slug)->get();
        return view('user.course.show', compact('data'));
    }
    public function store(Request $request)
    {
        $data=Course::with('price', 'level')->where('slug', $slug)->get();
        return view('user.course.show', compact('data'));
    }
}
