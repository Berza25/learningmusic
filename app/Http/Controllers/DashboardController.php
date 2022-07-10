<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $cart = Cart::where('user_id', $user)->count();
        dd($cart);
        return view('user.layout.partials.navbar', compact('cart'));
    }
}
