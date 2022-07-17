<?php
namespace App\Helpers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppHelper
{

    public function showCart()
    {
        $showcart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')
            ->count();

        return $showcart;
    }

}
?>
