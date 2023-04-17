<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  // use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('guest')->except('logout');
    // $this->middleware('guest:admin')->except('logout');
    // $this->middleware('guest:siswa')->except('logout');
    // $this->middleware('guest:pPerusahaan')->except('logout');
    // $this->middleware('guest:pSekolah')->except('logout');
  }

  public function isLogin()
  {
    // dd(Auth::guard('pSekolah')->check());
    if (Auth::guard('admin')->check()) return redirect('/admin');
    else if (Auth::guard('siswa')->check()) return redirect('/siswa');
    else if (Auth::guard('pPerusahaan')->check()) return redirect('/pPerusahaan');
    else if (Auth::guard('pSekolah')->check()) return redirect('/p-sekolah');
    else return view('user');
  }

  // public function showLoginForm()
  // {
  //   return view('auth.login');
  // }

  // public function login(Request $request)
  // {
  //   if ($request->user == 'admin') {
  //     $this->validate($request, [
  //       'email_a' => ['required', 'email'],
  //       'password' => ['required'],
  //     ]);
  //     $infoLogin = [
  //       'email_a' => $request->email_a,
  //       'password' => $request->password,
  //     ];
  //   }
  //   if ($request->user == 'admin') {
  //     if (Auth::guard('admin')->attempt($infoLogin)) {
  //       $request->session()->regenerate();
  //       return redirect('admin');
  //     }
  //   }
  //   return back();
  // }

  public function logout(Request $request): RedirectResponse
  {
    $guards = array_keys(config('auth.guards'));
    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
      };
    }
  }
}
