<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

abstract class Controller extends \App\Http\Controllers\Controller {

    protected $view = null;
    protected $viewIndex = null;
    protected $pageTitle;
    protected $viewArea = 'central';
    protected $viewTemplate = 'template';
    protected $acceptedParameters = [];

}