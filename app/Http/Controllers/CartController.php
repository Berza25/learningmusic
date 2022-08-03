<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Midtrans\CreateSnapTokenService;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order, Request $request)
    {
        $user = Auth::user()->id;
        $carts = Cart::with('user','course')->where(['user_id'=> $user, 'status_cart'=>'cart'])->get();

        $sumtot = Cart::with('user','course')->where(['user_id'=> $user, 'status_cart'=>'cart'])->sum('total');

        $ord = Order::with('user')->where(['user_id' => $user, 'payment_status' =>1])->firstOrFail();


        return view('user.cart.index', compact('carts', 'sumtot', 'ord'));
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
            'total' => 'required',
        ]);
        $user=Auth::user()->id;
        $no_invoice=rand(0,1000000);
        $status_cart='cart';

        $cart=Cart::create([
            'course_id' => $request->course_id,
            'user_id' => $user,
            'no_invoice' => $no_invoice,
            'status_cart' => $status_cart,
            'total' => $request->total
        ]);

        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        Alert::toast('Data Berhasil Dihapus', 'warning');
        return redirect()->back();
    }
}
