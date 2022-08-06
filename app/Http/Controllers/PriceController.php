<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Price;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = Price::get();
        return view('admin.price.index', compact('price'));
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
        // dd($request);
          $this->validate($request,[
            'price' => 'required',
            'status' => 'required'
        ]);
        $price = Price::create([
            'paid' => $request->price,
            'status' => $request->status
        ]);

        if($price){
            Alert::toast('Data Berhasil Ditambah', 'success');
            return redirect()->back();
        }else{
            Alert::toast('warning', 'Data Gagal Ditambah');
            return redirect()->back();
        }
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
    public function edit($id)
    {
        $price = Price::find($id);

        return view('admin.price.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        // dd($request);

        $request->validate([
            'paid'=> 'required',
            'status'=> 'required'
        ]);
        $price->update($request->all());

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect()->route('price.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        try {
            $price->delete();
            Alert::toast('Data Berhasil Dihapus', 'warning');
            return redirect()->back();
        } catch (Exception $e){
            Alert::toast('Price Terpakai di course', 'error');
            return redirect()->back();
        }

    }
}
