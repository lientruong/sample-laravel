<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {

    public function getIndex(Request $request) {

        return $this->view([
            'content' => 'pages/welcome/index',
        ]);
    }
}