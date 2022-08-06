<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\MyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 2,
                ]);
                Cart::where(['order_id'=> $order->id, 'status_cart'=>'order'])->update([
                    'status_cart' => 'checkout',
                ]);
                $cor = Cart::where(['user_id'=> $order->user_id, 'status_cart'=>'checkout'])->get();
                $mycourse = array();
                foreach($cor as $item)
                {
                    $mycourse[] = array(
                        'course_id'  => $item->course_id,
                        'user_id'    => $order->user_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    );
                }
                MyCourse::insert($mycourse);
            }

            if ($callback->isExpire()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 3,
                ]);
                Cart::where(['order_id'=> $order->id, 'status_cart'=>'order'])->delete();
            }

            if ($callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 4,
                ]);
                Cart::where(['order_id'=> $order->id, 'status_cart'=>'order'])->delete();
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
