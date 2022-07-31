<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // $snapToken = $order->snap_token;
        // if (empty($snapToken)) {
        //     // Jika snap token masih NULL, buat token snap dan simpan ke database

        //     $midtrans = new CreateSnapTokenService($order);
        //     $snapToken = $midtrans->getSnapToken();

        //     $order->snap_token = $snapToken;
        //     $order->save();
        // }
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = [
            'transaction_details' => [
                'order_id' => 'asdad',
                'gross_amount' => '1000'
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => '150000',
                    'quantity' => 1,
                    'name' => 'Flashdisk Toshiba 32GB',
                ],
                [
                    'id' => 2,
                    'price' => '60000',
                    'quantity' => 2,
                    'name' => 'Memory Card VGEN 4GB',
                ],
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.cart.index', compact('carts', 'sumtot', 'snapToken'));
    }
    public function paymentPost(Request $request){
        $json = json_decode($request->get('json'));
        $order = new Order();
        $order->fraud_status = $json->transaction_status;
        $order->name = Auth::user()->name;
        $order->email = Auth::user()->email;
        $order->number = '082123131311';
        $order->transaction_id = $json->transaction_id;
        $order->order_id = $json->order_id;
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');
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
        return redirect()->route('cart.index');
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
        return redirect()->back();
    }
}
