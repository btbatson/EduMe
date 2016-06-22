<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\User;

use Auth;
use Image;

class ProfileController extends Controller
{

    public function getProfile($username)
    {
        if(is_numeric($username))
        {
            $user = User::find($username);
        }
        else
        {
            $user = User::where('username', $username)->first();
        }

        if(!$user)
        {
            abort(404);
        }

        $posts = $user->posts()->get();

        $chat_members = Auth::user()->friends();

        return view('profile.index')
            ->with('user', $user)
            ->with('posts', $posts)
            ->with('authUserIsFriend', Auth::user()->isFriendWith($user))
            ->with('chat_members', $chat_members);

    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|alpha|max:50',
            'lastname' => 'required|alpha|max:50',
            'username' => 'required|alpha_dash|max:100|unique:users,username,'. Auth::user()->id,
            'email' => 'required|unique:users,email,'. Auth::user()->id .'|email|max:255',
            'profile_pic' => 'image',
            ]);

        if($request->hasFile('profile_pic'))
        {
            $image = $request->file('profile_pic');
            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('uploads/' . $filename);
            $img = Image::make($image->getRealPath())->save($path);

            Auth::user()->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'profile_pic' => asset('uploads/' . $filename),
            ]);
        }
        else
        {
            Auth::user()->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                ]);
        }

        return redirect()->route('profile.edit')->with('info', 'Your profile has been updated.');
    }

    public function getFriendsIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('profile.friends')->with('friends', $friends)->with('requests', $requests);
    }

    public function getAddFriend($username)
    {
        if(is_numeric($username))
        {
            $user = User::find($username);
        }
        else
        {
            $user = User::where('username', $username)->first();
        }

        if(!$user)
        {
            return redirect()->route('home')->with('info', 'that user could not be found');
        }

        if(Auth::user()->id === $user->id)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasFriendRequestPinding($user) or 
            $user->hasFriendRequestPinding(Auth::user()))
        {
            return redirect()->route('profile.index', ['username' => $user->username ? $user->username : $user->id])->with('info', 'Friend request already pinding');
        }

        if(Auth::user()->isFriendWith($user))
        {
            return redirect()->route('profile.index', ['username' => $user->username ? $user->username : $user->id])->with('info', 'You are already friends');
        }

        Auth::user()->addFriend($user);

        return redirect()->route('profile.index', ['username' => $user->username ? $user->username : $user->id])->with('info', 'Friend request sent');
    }

    public function getAcceptFriend($username)
    {
        if(is_numeric($username))
        {
            $user = User::find($username);
        }
        else
        {
            $user = User::where('username', $username)->first();
        }

        if(!$user)
        {
            return redirect()->route('home')->with('info', 'that user could not be found');
        }

        if(!Auth::user()->hasFriendRequestReceived($user))
        {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('profile.index', ['username' => $user->username ? $user->username : $user->id])->with('info', 'Friend request accepted');
    }


    public function postDeleteFriend($username)
    {
        if(is_numeric($username))
        {
            $user = User::find($username);
        }
        else
        {
            $user = User::where('username', $username)->first();
        }

        if(!Auth::user()->isFriendWith($user))
        {
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()->with('info', 'Friend deleted');
    }

    
}
