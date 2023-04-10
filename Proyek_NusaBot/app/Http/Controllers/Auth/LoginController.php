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
    $this->middleware('guest:admin')->except('logout');
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
    // dd($request->user);
    if ($request->user == 'admin') {
      // case 'siswa':
      //   $request->validate([
      //     'identify' => ['required', 'numeric'],
      //     'password' => ['required'],
      //   ]);
      //   $infoLogin = [
      //     'nis_s' => $request->identify,
      //     'password' => $request->password,
      //   ];
      //   break;

      // case 'pSekolah':
      //   $request->validate([
      //     'identify' => ['required', 'numeric'],
      //     'password' => ['required'],
      //   ]);
      //   $infoLogin = [
      //     'nip_ps' => $request->identify,
      //     'password' => $request->password,
      //   ];
      //   break;
      $this->validate($request, [
        'email_a' => ['required', 'email'],
        'password' => ['required'],
      ]);
      $infoLogin = [
        'email_a' => $request->email_a,
        'password' => $request->password,
      ];
      // break;

      // case 'pPerusahaan':
      //   $request->validate([
      //     'identify' => ['required', 'email'],
      //     'password' => ['required'],
      //   ]);
      //   $infoLogin = [
      //     'email_pp' => $request->identify,
      //     'password' => $request->password,
      //   ];
      //   break;
    }

    // dd(Auth::guard($request->user)->attempt($infoLogin), $request->session()->regenerate(), $infoLogin, Auth::check());

    if ($request->user == 'admin') {
      if (Auth::guard('admin')->attempt($infoLogin)) {
        // Auth::guard('admin');
        $request->session()->regenerate();
        return redirect()->intended('admin');
      }
    }

    // dd(
    // //   $request->user, $request->validate([
    // //   'identify' => ['required', 'email'],
    // //   'password' => ['required'],
    // // ]), 
    // // $infoLogin = [
    // //   'email_a' => $request->identify,
    // //   'password' => $request->password,
    // // ],
    // Auth::guard($request->user)->attempt($infoLogin), $request->session()->regenerate());

    return back();
    // ->withErrors([
    //   'email' => 'The provided credentials do not match our records.',
    // ])->onlyInput('email');
  }

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
    // Auth::logout();
  }
}
