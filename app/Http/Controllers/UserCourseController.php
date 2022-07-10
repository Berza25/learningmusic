<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    public function index()
    {
        $kelas=Course::get();
        return view('user.course.index', compact('kelas'));
    }
    public function show($slug)
    {
        $data = Course::with('price', 'level', 'videocourse', 'subjectmattercourse')->where('slug', $slug)->get();
        
        foreach($data as $itemcourse){
            $idcor[] = $itemcourse->id;
        }
        $st = Auth::user()->id;
        $cart = Cart::where('user_id', $st)
                ->where('status_cart', 'cart')
                ->get();
                
        foreach($cart as $key => $value){
            foreach($idcor as $key => $idc){
                if($value['course_id'] == $key){
                    $idcocart = $idc;
                }
            }
        }
        return view('user.course.show', compact('data', 'idcor', 'cart'));
        

    }
    public function store(Request $request)
    {
        $data=Course::with('price', 'level')->where('slug', $slug)->get();
        return view('user.course.show', compact('data'));
    }
}
