<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Lang;

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
    
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // check expire date
            $user = Auth::user();
            if ($user->expired_at < date('Y-m-d')) {                    
                Auth::logout();
                return redirect('login')->withErrors([
                    'email' => 'User already expire',
                ]);
            }
            // $priv = \App\Role_privilege::where('role_id',Auth::user()->role_id)->get();
            // foreach($priv as $key=>$pri){
            //     $privilege[$pri->page_id] = ['browse'=>$pri->browse,'add'=>$pri->add,'edit'=>$pri->edit,'delete'=>$pri->delete];
            // }
            // session(['privilege'=>$privilege]);
            return redirect()->intended('/admin');
        }else{
            return redirect('login')->withErrors([
                'email' => Lang::get('auth.failed'),
            ]);;
        }
    }
}
