<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Admin;

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

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

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
        $this->middleware('guest:web')->except('postLogout');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'username';
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('beranda');
        }
    }

    public function login(Request $request)
    {
        if (auth()->guard('web')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();    
            return redirect()->intended('beranda');
        } else {
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect admin login details!"]);
        }
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        session()->flush();

        return redirect()->route('auth.login');
    }
}
