<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use App\Models\MyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(!auth()->check()){
            $kelas = Course::with('price', 'level')
                        ->whereHas('price', function ($q) {
                            $q->where('paid', '>', 0);
                        })
                        ->get();
        }else if(Auth::user()->role == 'murid' || Auth::user()->role == 'admin'){
            $kelas = Course::get();
        }else{
            $kelas = Course::with('price', 'level')
                        ->whereHas('price', function ($q) {
                            $q->where('paid', '>', 0);
                        })
                        ->get();
        }


        return view('home', compact('kelas'));
    }
}
