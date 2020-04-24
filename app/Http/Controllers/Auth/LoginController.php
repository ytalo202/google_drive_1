<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    public function redirectToProvider()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')
            ->scopes(
                ["https://www.googleapis.com/auth/drive",
                "https://www.googleapis.com/auth/drive.appdata",
                "https://www.googleapis.com/auth/drive.file",
                "https://www.googleapis.com/auth/drive.metadata",
                "https://www.googleapis.com/auth/drive.metadata.readonly",
                "https://www.googleapis.com/auth/drive.scripts",


                "https://www.googleapis.com/auth/classroom.courses",
                ])
            ->with($parameters)
            ->redirect();
    }

    public function handleProviderCallback()
    {
        $userLogin = Socialite::driver('google')->stateless()->user();
//        dd($userLogin);
        $user = User::updateOrCreate(['email' => $userLogin->email],
            ['refresh_token' => $userLogin->token,
                'name' => $userLogin->name]);
        Auth::login($user, true);
        return redirect()->to('/');
    }

    public function logout(Request $request)
    {
        session('g_token','');
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
