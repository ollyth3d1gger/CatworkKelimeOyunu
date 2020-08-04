<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;
use Hash;
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

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'captcha_code' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        session_start();
        $code = $request->input('captcha_code');
        $value = $_SESSION["captcha_code"];
        if($code == $value){

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('/admin');
            }
        }
        else{







            flash('Hatalı Giriş Bilgileri!')->error();
            return redirect()->back();

        }

    }
    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return redirect('/home');
    }



//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    // *
    //  * Obtain the user information from GitHub.
    //  *
    //  * @return \Illuminate\Http\Response
     
    public function handleProviderCallback($service)
    {
        $userSocial = Socialite::driver($service)->user();

        //return $userSocial->name;
        $findUser=User::where('email',$userSocial->email)->first();
        if($findUser)
        {
             Auth::login($findUser);
                return '<script>if (window.opener) {window.opener.location.href="/quickquiz/public"; window.close();}</script>';

        }
        else
        {
        $user = new User;
        $user->name = $userSocial->name;
        $user->email = $userSocial->email;
        $user->password = Hash::make(123456);
        $user->role = "S";
        $user->save();
        $this->guard()->login($user);

       
        return '<script>if (window.opener) {window.opener.location.href="/quickquiz/public"; window.close();}</script>';
        }
        
    }
}
  
