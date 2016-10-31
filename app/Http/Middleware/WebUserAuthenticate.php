<?php

namespace App\Http\Middleware;

use App\Models\WebUser;
use Closure;

class WebUserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $remember_token = $request->session()->get('remember_token');
        $validate_token = WebUser::where('remember_token', $remember_token)->first();
        if (isset($validate_token->remember_token)) {
            $request->session()->put('user_id', $validate_token->id);
            $request->session()->put('user_name', $validate_token->name);
            return $next($request);
        } else {
            $request->session()->flush();
            return redirect('');
        }
    }
}
