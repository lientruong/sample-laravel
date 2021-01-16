<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $view = null;
    protected $viewIndex = null;
    protected $pageTitle;
    protected $viewArea = 'central';
    protected $viewTemplate = 'template';
    protected $acceptedParameters = [];
    protected $useRecaptcha = false;

    public function __construct() {
        $paths = config('view.paths');
        foreach($paths as $k => $v) {
            $paths[$k] = $v . DIRECTORY_SEPARATOR . $this->viewArea;
        }
        config(['view.paths' => $paths]);
        $this->viewArea = $this->viewArea . DIRECTORY_SEPARATOR;
        View::share('view', $this->view ? ($this->viewArea . $this->view) : null);
        $this->addHtmlHeadMeta(['charset' => 'utf-8']);
        $this->addHtmlHeadMeta(['http-equiv' => "X-UA-Compatible", 'content' => "IE=edge"]);
        $this->addHtmlHeadMeta(['name' => "viewport", 'content' => "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=0"]);
        $this->addHtmlHeadMeta(['name' => 'author', 'content' => Config::get('company.name')]);
        $this->addHtmlHeadMeta(['name' => 'robots', 'content' => 'index, follow']);
        $this->addHtmlHeadMeta(['name' => 'generator', 'content' => Config::get('company.name')]);
        $this->addHtmlHeadLink(['name' => 'csrf-token', 'content' => csrf_token()]);
        $this->pageTitle = empty($this->pageTitle) ? Config::get('company.defaultTitle') : $this->pageTitle;
    }

    protected function filterParams($params = [], $acceptedParams = []) {
        $d = [];
        foreach($params as $k => $v) {
            if(!array_key_exists($k, empty($acceptedParams) ? $this->acceptedParameters : $acceptedParams))
                return [];
            $d[$k] = urldecode($v);
        }
        return $d;
    }

    protected function view($viewObjects = []) {
        if(!empty($this->useRecaptcha))
            $this->addJavascript(Config::get('recaptcha.javascript'), false);
        $this->addHtmlHeadMeta(['name' => 'csrf-token', 'content' => csrf_token()]);
        if(isset($viewObjects['view'])) {
            $viewObjects['view'] = $viewObjects['view'];
        }
        elseif(!empty($this->view))
            $viewObjects['view'] =  $this->view;
        $viewObjects['viewIndex'] = $this->viewIndex;
        if(session()->has('flash_notification')) {
            View::share('notifications', session()->get('flash_notification'));
        }
        View::share('pageTitle', $this->pageTitle);
        return view($this->viewTemplate, $viewObjects);
    }

    protected function addHtmlHeadLink($attributes = []) {
        $els = View::shared('linkElements', []);
        if(!empty($attributes)) {
            array_push($els, $attributes);
            View::share('linkElements', $els);
        }
    }

    protected function addHtmlHeadMeta($attributes = []) {
        $els = View::shared('metaElements', []);
        if(!empty($attributes)) {
            array_push($els, $attributes);
            View::share('metaElements', $els);
        }
    }

    protected function addCss($location = '', $attributes = []) {
        $css = View::shared('cssElements', []);
        array_push($css, ['location' => $location, 'attributes' => $attributes]);
        View::share('cssElements', $css);
    }

    protected function addJavascript($location = '', $isFooter = false, $attributes = []) {
        $var = $isFooter ? 'javascriptFooterElements' : 'javascriptElements';
        $js = View::shared($var, []);
        array_push($js, ['location' => $location, 'attributes' => $attributes]);
        View::share($var, $js);
    }

    protected function json($callback = '') {
        $json = ['message' => '', 'statusCode' => 200, 'status' => 'success'];
        try {
            if(!Request::ajax())
                throw new \Exception('Forbidden', 400);
            $json['data'] = $callback();
        }
        catch(\Exception $e) {
            $json['message'] = $e->getMessage();
            $json['statusCode'] = $e->getCode();
            $json['status'] = 'error';
        }
        return response()->json($json)->withHeaders(['Content-Type' => 'application/json']);
    }


    protected function responseDownload($fileString = '', $fileName = '', $headers = [], $disposition = null, $deleteAfterSend = false) {
        $a = response()->download($fileString, $fileName, $headers, $disposition)->deleteFileAfterSend($deleteAfterSend);
        ob_end_clean();
        return $a;
    }
}
