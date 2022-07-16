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
        $data = Course::with('price', 'level')->where('slug', $slug)->get();

        $cart = [];
        if (auth()->check()) {
            $cart = Cart::whereHas('course', function($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                // ->where('status_cart', 'cart')
                ->orderBy('id', 'desc')
                ->get();
        }

        // dd($cart);

        return view('user.course.show', compact('data', 'cart'));

    }
}
