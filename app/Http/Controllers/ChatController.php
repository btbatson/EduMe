<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Message;
use App\Model\User;
use App\Model\Chat;
use Auth;

class ChatController extends Controller
{
    //
    public function postMessage(Request $request)
    {
        $chat = Chat::where('user_id', $request->input('from'))
            ->where('friend_id', $request->input('to'))->first();

        if(!$chat)
        {
            $chat = Chat::where('user_id', $request->input('to'))
            ->where('friend_id', $request->input('from'))->first();

            if(!$chat)
            {
                $chat = new chat;
                $chat->user_id = $request->input('from');
                $chat->friend_id = $request->input('to');

                $chat->save();
            }
        }

    	$message = new Message;
        $message->message = $request->input('message');
        $message->chat_id = $chat->id;
    	$message->user_id = $request->input('from');
    	$message->save();
    	if(!Auth::guest())
    		return "user";

    	return "message saved";

    }

    public function getMessages($id)
    {
        $user = User::find($id);

        if(!$user)
        {
            abort(404);
        }
        
        if(!Auth::user()->isChat($user))
        {
            $chat = new Chat;
            $chat->user_id = Auth::user()->id;
            $chat->friend_id = $user->id;
            $chat->save();
        }
        else
        {
            $chat = Auth::user()->getChatWith($user);
        }

        return view('chat.chat')->with('chat', $chat);

    }
    public function getList()
    {
        $chat_members = Auth::user()->friends();
        // return Auth::user()->getChatWith(User::find(2))->messages;
        return view('chat.list')->with('chat_members', $chat_members);
    }
}
