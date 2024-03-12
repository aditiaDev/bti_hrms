<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

  use AuthenticatesUsers;

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

  public function login()
  {
    if (Auth::check()) {
      return redirect('home');
    } else {
      return view('auth.login');
    }
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      if (Auth::user()->isactive <> 1) {
        Auth::logout();
        Session::flash('error', 'Your account is not activated yet.');
        return redirect('/');
      }

      $request->session()->regenerate();

      return redirect()->intended('home');
    }

    Session::flash('error', 'Username atau Password Salah');
    return redirect('/');
  }

  // public function logout()
  // {
  //   Auth::logout();
  //   return redirect('/');
  // }

  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    if ($response = $this->loggedOut($request)) {
      return $response;
    }

    return $request->wantsJson()
      ? new JsonResponse([], 204)
      : redirect('/');
  }

  /**
   * The user has logged out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return mixed
   */
  protected function loggedOut(Request $request)
  {
    //
  }

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }
}
