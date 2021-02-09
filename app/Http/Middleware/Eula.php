<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Eula
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $eulaRoute = 'eula';
    protected $bypassedRoutes = [
        'logout',
        'eula',
    ];
    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     * Check if the user agreed to terms and conditions before allowing user to proceed to site
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!Auth::check() || in_array($request->route()->uri, $this->bypassedRoutes))
            return $next($request);
        if( !$request->session()->get('eula')) {
            return redirect('eula');
        }
        return $next($request);
    }
}
