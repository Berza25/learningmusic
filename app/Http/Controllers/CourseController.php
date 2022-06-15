<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Price;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\DetailCourse;
use App\Models\SubjectMatterCourse;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::get();
        $prices = Price::get();
        $materi = Course::with('level', 'videocourse','subjectmattercourse')->get();

        // dd($materi);

        return view('admin.course.index', compact('levels', 'prices', 'materi'));
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
            'title' => 'required',
            'level_id' => 'required',
            'price_id' => 'required',
            'video' => 'required',
            'video.*' => 'required',
            'fmateri' => 'required',
            'fmateri.*' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:10000'

        ]);
        // dd($request);

        $newImage = date('YmdHis'). '-' . $request->title . '.' . $request->image->extension();
        $request->file('image')->move(public_path('materiimage'), $newImage);

        $materi = Course::create([
            'title' => $request->title,
            'level_id' => $request->level_id,
            'price_id' => $request->price_id,
            'description' => $request->description,
            'image' => $newImage,
            'slug' => Str::slug($request->title)
        ]);
        if($request->hasfile('fmateri'))
         {
            foreach($request->file('fmateri') as $file)
            {
                $newSubject = time().rand(1,10000). '-' . $request->title . '.' . $file->getClientOriginalName();
                $file->move(public_path('foldermateri'), $newSubject);
                $masukfile = new SubjectMatterCourse();
                $masukfile->subject_matter= $newSubject;
                $masukfile->course_id = $materi->id;
                $masukfile->save();
}
        }

        foreach($request->video as $itemvid){
            $masukvideo = new VideoCourse();
            $masukvideo->video = $itemvid;
            $masukvideo->course_id = $materi->id;
            $masukvideo->save();
        }




        // $file = new DetailCourse();
        // $file->course_id = $materi->id;
        // $file->fmateri = $files;
        // $file->save();

        // $vid = [];

        // foreach ($files as $itemfil) {
        //     $fil[] = $itemfil;
        // }

        // $finalArray = array();
        //     foreach($request->addMoreInputFields as $key => $values){
        //         array_push($finalArray, array(
        //             'video' => $values['video'],
        //             "created_at"=> Carbon::now(),
        //             "updated_at"=> Carbon::now()
        //         ));
        //     }

        // dd($finalArray);

        // $detailcourse = new DetailCourse();
        // $detailcourse->course_id = $materi->id;
        // $detailcourse->fmateri=json_encode($files);
        // $detailcourse->video = json_encode($vid);
        // $detailcourse->save();

        //     'course_id' => $materi->id,
        //     'fmateri' => $files,
        //     'video' => $vid
        // ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $prices=Price::get();
        $levels=Level::get();
        return view('admin.course.edit', compact('course','prices','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'=> 'required',
            'subject'=> 'mimes:pdf|max:10000',
            'level_id'=> 'required',
            'price_id'=> 'required',
            'link'=> 'required',
            'description'=> 'required',
        ]);

        $cour=$request->all();
        if ($file = $request->file('subject')) {
            File::delete('foldermateri/'.$course->subject);
            $destinationPath = 'foldermateri/';
            $profileMateri = date('YmdHis'). '-' . $request->title . '.' . $request->subject->extension();
            $file->move($destinationPath, $profileMateri);
            $cour['subject'] = "$profileMateri";
        }else{
            unset($cour['subject']);
        }

        $course->update($cour);
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        File::delete('foldermateri/'.$course->subject);

        return redirect()->back();
    }
}
