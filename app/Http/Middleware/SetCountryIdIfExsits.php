<?php

namespace App\Http\Middleware;

use App\Models\Country;
use App\Models\User;
use App\Services\HandleCountrySelection;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCountryIdIfExsits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if(auth()->user()->countries->count() == 0){
                session()->flash('message' , 'You must have at least one country to start');
                session()->flash('error-classes', 'text-red-600 dark:text-red-400');
                return redirect()->route('settings');
            } 
            (new HandleCountrySelection())->selectFirstCountryIfUserLastSelectedCountryIsNull();
        }
        return $next($request);
    }
}
