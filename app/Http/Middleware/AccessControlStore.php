<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userStore = null;

        if (auth()->user()->store()->count()) {
            $userStore = auth()->user()->store->id;
        }

        $storeId = $request->route('store');


        if($userStore != $storeId && $userStore != null && $storeId != '') {
 
            flash('Você não pode realizar essa operação!')->warning();
 
            return redirect()->route('inicial');
        }

        return $next($request);
    }
}
