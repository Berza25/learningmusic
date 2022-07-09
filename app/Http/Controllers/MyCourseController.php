<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
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
        $materi=MyCourse::with('course','user')->where('user_id','=', $user)->get();
        return view('user.mycourse.index',compact('materi'));
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
        $cart=Cart::where(['user_id'=> $user, 'status_cart'=>'cart'])
            ->select('course_id')
            ->get();


            $finalArray = array();
            foreach($cart as $key => $value){
                array_push($finalArray, array(
                    'course_id' => $value['course_id'],
                    'user_id' => $user,
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now()
                ));
            }

        // dd($finalArray);

        MyCourse::insert($finalArray);

        Cart::where('user_id', $user)->update(['status_cart' => 'checkout']);

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
        $data = MyCourse::findOrFail($id)
                        ->with('user', 'course')
                        ->where('user_id', $user)
                        ->get();
        // dd($data);
        return view('user.mycourse.show', compact('data'));
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
}
