<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Level;
use App\Models\Price;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    public function index(Request $request)
    {
        $lev = Level::get();
        $pri = Price::get();

        // $ddsa = $request->level;
        // dd($ddsa);

        $filter = $request->query('price');

        if(!auth()->check()){
            if(!empty($filter)){
                $kelas = Course::with('level', 'price')
                        ->whereHas('level', function ($q) use ($request) {
                            $q->where('grade', 'like', '%' . $request->level . '%');
                        })
                        ->whereHas('price', function ($q) use ($request) {
                            $q->where('status', 'like', '%' . $request->price . '%');
                        })
                        ->whereHas('price', function ($q){
                            $q->where('paid', '>', 0);
                        })
                        ->paginate(4);
            }else{
                $kelas = Course::with('price', 'level')
                        ->whereHas('price', function ($q) {
                            $q->where('paid', '>', 0);
                        })
                        ->paginate(4);
            }
        }else if(Auth::user()->role == 'murid' || Auth::user()->role == 'admin'){
            if(!empty($filter)){
                $kelas = Course::with('level', 'price')
                ->whereHas('level', function ($q) use ($request) {
                    $q->where('grade', 'like', '%' . $request->level . '%');
                })
                ->whereHas('price', function ($q) use ($request) {
                    $q->where('status', 'like', '%' . $request->price . '%');
                })
                ->paginate(4);
            }else{
                $kelas = Course::with('price', 'level')->paginate(4);
            }
        }else{
            $kelas = Course::with('level', 'price')
                ->whereHas('level', function ($q) use ($request) {
                    $q->where('grade', 'like', '%' . $request->level . '%');
                })
                ->whereHas('price', function ($q) use ($request) {
                    $q->where('status', 'like', '%' . $request->price . '%');
                })
                ->whereHas('price', function ($q){
                    $q->where('paid', '>', 0);
                })
                ->paginate(4);
        }

        return view('user.course.index', compact('kelas', 'lev', 'pri'));
    }
    public function show($slug)
    {
        $data = Course::with('price', 'level', 'lesson', 'cart', 'comment')->where('slug', $slug)->get();

        foreach($data as $item){
            $idcor = $item->id;
        }

        $les = Lesson::with('course')->where('course_id', $idcor)->first();
        // dd($les);

        return view('user.course.show', compact('data', 'les'));

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
