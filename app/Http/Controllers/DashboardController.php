<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use App\Models\MyCourse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $course = Course::count();
        // dd($course);
        $mycor = User::where('role', 'user')->count();
        $murid = User::where('role', 'murid')->count();
        $admin = User::where('role', 'admin')->count();

        $cour = Course::with('mycourse')->get();

        $datarate = MyCourse::with('user', 'course', 'course.lesson')->get();

        // $dataprog = User::all()->lessonstudent()->where('course_id', $item->course->id)->count();
        // $materi = MyCourse::with('course','user', 'course.lesson')->where([['user_id', Auth::user()->id], ['course_id', $idcor]])->get();
        // foreach($materi as $itemmat){
        //     $dl = $itemmat->course->lesson->count();
        // }
        // $persen = $dataprog/$dl*100;



        return view('admin.dashboard', compact('course', 'mycor', 'murid', 'cour', 'datarate', 'admin'));
    }
}
