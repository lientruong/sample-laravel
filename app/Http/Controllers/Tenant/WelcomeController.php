<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WelcomeController extends Controller {

    public function getIndex(Request $request) {

        if(Auth::check()) {
            //grab the order count for this tenant
            $orderCount = Order::count();
            $latestOrder = Order::orderBy('created_at', 'desc')->first();

            //add in a random order
            Order::create(['document_code' => Str::random(12)]);
        }

        //pass the data to the view layer
        return $this->view([
            'content' => 'pages/welcome/index',
            'orderCount' => $orderCount,
            'latestOrder' => $latestOrder,
        ]);
    }
}