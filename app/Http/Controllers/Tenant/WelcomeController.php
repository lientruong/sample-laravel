<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {

    public function getIndex(Request $request) {
        dd(Auth::user());
        return $this->view([
            'content' => 'pages/welcome/index',
        ]);
    }
}