<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string $guard = null): Response
  {

    if ($guard == "admin" && Auth::guard($guard)->check()) {
      return redirect('/admin');
    }
    if ($guard == "siswa" && Auth::guard($guard)->check()) {
      return redirect('/siswa');
    }
    if ($guard == "pPerusahaan" && Auth::guard($guard)->check()) {
      return redirect('/pPerusahaan');
    }
    if ($guard == "pSekolah" && Auth::guard($guard)->check()) {
      return redirect('/pSekolah');
    }

    // $guards = empty($guards) ? [null] : $guards;

    // foreach ($guards as $guard) {
    //     if (Auth::guard($guard)->check()) {
    //         return redirect(RouteServiceProvider::HOME);
    //     }
    // }

    return $next($request);
  }
}
