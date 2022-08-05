<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {

        $user = Auth::user()->id;
        $carts = Cart::with('user','course')->where(['user_id'=> $user, 'status_cart'=>'order'])->get();

        $item_details = array();
        foreach($carts as $item)
        {
            $item_details[] = array(
                'id'        => $item->id,
                'price'     => $item->total,
                'quantity'  => 1,
                'name'      => $item->course->title,
            );
        }

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->gross_amount,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
