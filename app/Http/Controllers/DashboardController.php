<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use App\Models\MyCourse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $course = Course::count();
        // dd($course);
        $mycor = User::where('role', 'user')->count();

        return view('admin.dashboard', compact('course', 'mycor'));
    }
}
