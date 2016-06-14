<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function postApiRegister(Request $request)
    {

        if(!$request->input('firstname') or !$request->input('lastname') or 
            !$request->input('email') or !$request->input('password'))
        {
            return $this->errorMissingAttribute();
        }

        $data = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];
        
        $validate = Validator::make($data,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validate->fails())
        {
            return response()->json([
            'success' => 'false',
            'message' => $validate->errors()->first()
            ], 200);
        }

        $user = User::create($data);
        
        return response()->json([
            'success' => 'true',
            'user' => $user,
            ], 200);
        
    }

    public function postApiLogin(Request $request)
    {
        if(!$request->input('email') or !$request->input('password'))
        {
            return $this->errorMissingAttribute();
        }

        if(Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
            'success' => 'true',
            'user' => Auth::user(),
            ], 200);
        }
        else
        {
            return response()->json([
            'success' => 'false',
            'message' => "This user doesn't exist"
            ], 200);
        }
    }
}
