<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\MyCourse;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $materi = MyCourse::with('course','user', 'course.lesson')->where('user_id','=', $user)->get();
       
        return view('user.mycourse.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user()->id;

        $this->validate($request,[
            'course_id' => 'required',
        ]);

        MyCourse::create([
            'course_id' => $request->course_id,
            'user_id' => $user
        ]);

        return redirect()->route('mycourse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $data = MyCourse::where('id', $id)
                        ->with('user', 'course', 'course.lesson')
                        ->where('user_id', $user)
                        ->get();

        foreach($data as $item){
            $idcor = $item->course->id;
        }

        $dataprog = Auth::user()->lessonstudent()->where('course_id', $item->course->id)->count();
        $materi = MyCourse::with('course','user', 'course.lesson')->where([['user_id', Auth::user()->id], ['course_id', $idcor]])->get();
        foreach($materi as $itemmat){
            $dl = $itemmat->course->lesson->count();
        }
        $persen = $dataprog/$dl*100;

        $les = Lesson::with('course')->where('course_id', $idcor)->first();

        return view('user.mycourse.show', compact('data', 'persen', 'dl', 'les'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rating($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $course->mycourse()->updateExistingPivot(auth()->id(), ['rating' => $request->get('rating')]);

        return redirect()->back()->with('success', 'Thank you for rating.');
    }
}
