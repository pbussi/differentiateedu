<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
  
class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectToTeacher = '/mycourses';
    protected $redirectToStudent = '/myactivities';
  
    /**
     * Call the view
     */
    public function index()
    {
        return view('login');
    }
  
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        if (count(Auth::user()->teachers)>0)
            return redirect($this->redirectToTeacher);
        else{
            return redirect($this->redirectToStudent);
        }
    }
    
    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            $authUser->name=$user->name;
            $authUser->provider=$provider;
            $authUser->provider_id=$user->id;
            $authUser->save();
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }
}

