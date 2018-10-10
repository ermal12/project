<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
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
            // App\Providers\BroadcastServiceProvider::class,


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
    if ( $user->isAdmin() ) {// do your margic here
        return redirect()->route('admin.index');
    } else

        // return redirect()->route('user.index',$user->id);
        // return redirect('admin/article/' . $id . '/edit')
         return redirect('user/profile/' . $user->id );

    }





    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }



        /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
 public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();


        $findUser = User::where('email',$userSocial->email)->first();

        if($findUser){
       Auth::login($findUser);
       return redirect ('user/' . $findUser->id );

        } else {

       // return $userSocial->name;
       $user = new User;
       $user->name = $userSocial->name;
       $user->email = $userSocial->getEmail();
       $user->password = bcrypt(123456);
       $user->save();

     Auth::login($user);
       return redirect ('user/' . $user->id );
        }

    }

    public function redirectToProvider1()
    {
        return Socialite::driver('google')->redirect();
    }



        /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
 public function handleProviderCallback1()
    {
        $userSocial = Socialite::driver('google')->user();


        $findUser = User::where('email',$userSocial->email)->first();

        if($findUser){
       Auth::login($findUser);
       return redirect ('user/' . $findUser->id );

        } else {

       // return $userSocial->name;
       $user = new User;
       $user->name = $userSocial->name;
       $user->email = $userSocial->email;
       $user->password = bcrypt(123456);
       $user->save();
     Auth::login($user);
       return redirect ('user/' . $user->id );
        }

    }


}
