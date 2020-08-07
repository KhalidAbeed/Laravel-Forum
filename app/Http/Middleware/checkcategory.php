<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class checkcategory
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
        $count=Category::all()->count();
        if($count == 0)
        {
            session()->flash('error','there must be at least one category');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
