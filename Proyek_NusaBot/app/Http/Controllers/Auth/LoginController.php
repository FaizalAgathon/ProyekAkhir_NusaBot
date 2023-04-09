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
    // $this->middleware('guest:admin')->except('logout');
    // $this->middleware('guest:siswa')->except('logout');
    // $this->middleware('guest:pPerusahaan')->except('logout');
    // $this->middleware('guest:pSekolah')->except('logout');
  }

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    switch ($request->user) {
      case 'siswa':
        $request->validate([
          'identify' => ['required', 'numeric'],
          'password' => ['required'],
        ]);
        $infoLogin = [
          'nis_s' => $request->identify,
          'password' => $request->password,
        ];
        break;

      case 'pSekolah':
        $request->validate([
          'identify' => ['required', 'numeric'],
          'password' => ['required'],
        ]);
        $infoLogin = [
          'nip_ps' => $request->identify,
          'password' => $request->password,
        ];
        break;

      case 'admin':
        $request->validate([
          'identify' => ['required', 'email'],
          'password' => ['required'],
        ]);
        $infoLogin = [
          'email_a' => $request->identify,
          'password' => $request->password,
        ];
        break;

      case 'pPerusahaan':
        $request->validate([
          'identify' => ['required', 'email'],
          'password' => ['required'],
        ]);
        $infoLogin = [
          'email_pp' => $request->identify,
          'password' => $request->password,
        ];
        break;
    }

    if (Auth::guard($request->user)->attempt($infoLogin)) {
      $request->session()->regenerate();
      switch ($request->user) {
        case 'siswa':
          return redirect('/siswa');
          break;
        case 'admin':
          return redirect('/admin');
          break;
        case 'pPerusahaan':
          return redirect('/pPerusahaan');
          break;
        case 'pSekolah':
          return redirect('/pSekolah');
          break;
      }
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
