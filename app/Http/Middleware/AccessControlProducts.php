<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlProducts
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

        $productId = $request->route('product');

        if($productId != null && $userStore != null) {

            $product = \App\Models\Product::findOrFail($productId);
    
            if($product->store_id !== $userStore) {
 
                flash('Você não pode realizar essa operação!')->warning();
                return redirect()->route('inicial');
            }
    
        }

        //dd($productId);

        return $next($request);
    }

}
