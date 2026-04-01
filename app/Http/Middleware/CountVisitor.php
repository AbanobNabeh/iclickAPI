<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
{
  if (!Session::has('visited')) {
    $visitor = Visitor::firstOrCreate([], ['count' => 0]);
    $visitor->increment('count');

    Session::put('visited', true);
}

    return $next($request);
}
}
