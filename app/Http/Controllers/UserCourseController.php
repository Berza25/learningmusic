<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    public function index()
    {
        $kelas = Course::with('price', 'level')->paginate(3);
        $lev = Level::get();
        $pri = Price::get();
        return view('user.course.index', compact('kelas', 'lev', 'pri'));
    }
    public function show($slug)
    {
        $data = Course::with('price', 'level', 'lesson', 'cart', 'comment')->where('slug', $slug)->get();

        return view('user.course.show', compact('data'));

    }
    public function comment(Request $request)
    {
        // dd($request);

        $this->validate($request,[
            'konten' => 'required|string',
            'course_id' => 'required',
            'parent' => 'required'
        ]);

        Comment::create([
            'course_id' => $request->course_id,
            'user_id' => Auth::user()->id,
            'konten' => $request->konten,
            'parent' => $request->parent
        ]);

        return redirect()->back();
        // dd($request->all());
    }
}
