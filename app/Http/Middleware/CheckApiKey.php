<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Stream;

class CheckApiKey
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
      $streamKey = Stream::where('key', '=', $request->key)->exists();
        if ($streamKey != true) {
            //return redirect('home');
            dd($request);
        }
        return $next($request);
    }
}
