<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Price;
use App\Models\Course;
use Illuminate\Support\Str;
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
        $materi = Course::with('level', 'price')->get();

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
