<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    if ($request->user == 'siswa') {
      $credentials = $request->validate([
        'nis_s' => ['required', 'numeric'],
        'password' => ['required'],
      ]);
    } else if ($request->user == 'pSekolah') {
      $credentials = $request->validate([
        'nip_ps' => ['required', 'numeric'],
        'password' => ['required'],
      ]);
    } else if ($request->user == 'admin') {
      $credentials = $request->validate([
        'email_a' => ['required', 'email'],
        'password' => ['required'],
      ]);
    } else if ($request->user == 'pPerusahaan') {
      $credentials = $request->validate([
        'email_pp' => ['required', 'email'],
        'password' => ['required'],
      ]);
    }

    if (Auth::guard($request->user)->attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('dashboard');
    }

    return back();
    // ->withErrors([
    //   'email' => 'The provided credentials do not match our records.',
    // ])->onlyInput('email');
  }

  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
