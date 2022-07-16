<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\MyCourse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::get();
        $lesson = Lesson::with('course')->get();

        return view('admin.lesson.index', compact('courses', 'lesson'));
    }

    public function indexuser($course_id)
    {
        $lesson = Lesson::with('course')->where('course_id', $course_id)->get();

        return view('user.lesson.index', compact('lesson'));
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
        $this->validate($request,[
            'course_id' => 'required',
            'title' => 'required',
            'subject_matter' => 'nullable|mimes:pdf|max:10000',
            'video' => 'nullable|string',

        ]);

        if($request->file('subject_matter')){
            $newMateri = date('YmdHis'). '-' . $request->title . '.' . $request->subject_matter->extension();
            $request->file('subject_matter')->move(public_path('foldermateri'), $newMateri);
            Lesson::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'embed_id' => $request->video,
                'subject_matter' => $newMateri
            ]);
        }else{
            Lesson::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'embed_id' => $request->video,
            ]);
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    public function usershow($slug)
    {
        $data = Lesson::where('slug', $slug)->get();

        return view('user.lesson.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
