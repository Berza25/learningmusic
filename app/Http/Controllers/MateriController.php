<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Price;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels=Level::get();
        $prices=Price::get();
        $materi=Course::with('level')->get();

        return view('admin.materi.index',compact('levels','prices','materi'));
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
            'subject' => 'required|mimes:pdf|max:10000',
            'level_id' => 'required',
            'price_id' => 'required',
            'link_video' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:10000'
        
        ]);
        $newSubject = date('YmdHis'). '-' . $request->title . '.' . $request->subject->extension();
        $newImage = date('YmdHis'). '-' . $request->title . '.' . $request->image->extension();
        $request->file('subject')->move(public_path('foldermateri'), $newSubject);
        $request->file('image')->move(public_path('materiimage'), $newImage);
        $materi=Course::create([
            'title' => $request->title,
            'subject' => $newSubject,
            'level_id' => $request->level_id,
            'price_id' => $request->price_id,
            'link' => $request->link_video,
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
    public function edit(Course $materi)
    {
        $prices=Price::get();
        $levels=Level::get();
        return view('admin.materi.edit', compact('materi','prices','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $materi)
    {
        $request->validate([
            'title'=> 'required',
            'subject'=> 'required|mimes:pdf|max:10000',
            'level_id'=> 'required',
            'price_id'=> 'required',
            'link_video'=> 'required',
            'description'=> 'required',
        ]);

        $cour=$request->all();
        if ($file = $request->file('subject')) {
            File::delete('foldermateri/'.$materi->subject);
            $destinationPath = 'foldermateri/';
            $profileMateri = date('YmdHis'). '-' . $request->title . '.' . $request->subject->extension();
            $file->move($destinationPath, $profileMateri);
            $cour['subject'] = "$profileMateri";
        }else{
            unset($cour['subject']);
        }

        $materi->update($cour);
        return redirect()->route('admin.materi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $materi)
    {
        $materi->delete();
        File::delete('foldermateri/'.$materi->subject);

        return redirect()->back();
    }
}
