<?php

namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Jeet\Chattle\app\Models\Chat;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        if(auth()->check()){
            $user = auth()->user();
            $email = $user->email;
            $name = $user->name;
        }

        $chat = Chat::where("email", $email)->first();
        $chat = $chat ? $chat : new Chat;
        $chat->name = $name;
        $chat->email = $name;
        $chat->last_sender = 'customer';
        $chat->unseen_messages = 0;
        $chat->save();
        return response()->json($chat, 200);
    }
}
