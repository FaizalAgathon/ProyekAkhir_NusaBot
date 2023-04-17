<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

  public function loginForm()
  {
    return view('auth.login', [
      'nameValidate' => 'email_a'
    ]);
  }

  public function validator(Request $request)
  {
    $this->validate($request, [
      'email_a' => ['required', 'email'],
      'password' => ['required'],
    ]);
    $infoLogin = [
      'email_a' => $request->email_a,
      'password' => $request->password,
    ];

    if (Auth::guard('admin')->attempt($infoLogin)) {
      
      $request->session()->regenerate();
      // dd(auth('admin'), Auth::guard('admin'), Auth::check(), Auth::guard('admin')->check());
      return redirect('/admin');
    }
    return back();
  }
  
    public function dashboard()
    {
      return view('users.admin.index');
    }
}
