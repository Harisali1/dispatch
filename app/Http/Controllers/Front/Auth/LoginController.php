<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Front\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo ='/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /*
         * Logged in user should not be able to visit login page, unless logged out
         *
         * It's redirection is managed from App > Http > Middleware > RedirectIfAuthenticated
         */
        $this->middleware('guest:web')->except('logout');
        parent::__construct();
    }

    /**
     * Update Auth Guard
     *
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Show Login view
     *
     */
    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    /**
     * Login call
     *
     */
    public function login(Request $request)
    {
        $user_check = User::where('email',$request->get('email'))->first();

        if (!$user_check)
        {
            return Redirect::to('login')
                ->withErrors('These credentials do not match our records.');
        }
        if($user_check->status == 0){
            return Redirect::to('login')
                ->withErrors('Your account has been temporary in active.');
        }
        if (!empty($user_check->email_verify_token))
        {
            return Redirect::to('login')
                ->withErrors('Your account not been activate, Please check your inbox/spam');
        }

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get Credential
     *
     */
    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        return [
            'email'     => $request->{$this->username()},
            'password'  => $request->password,
           // 'remember' => true
          //  'role_id' => 2,
           // 'is_active' => 1
        ];
    }

    /**
     * Logout
     *
     */
    public function logout(Request $request)
    {
        /*
         * Here, admin guard is being called by $this->guard()
         */
        $this->guard()->logout();

        // $request->session()->invalidate();

        return Redirect::to('login');
    }

    /**
     * Handle forgot password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function forgotPassword(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('admin.auth.forgot-password');
    }
}
