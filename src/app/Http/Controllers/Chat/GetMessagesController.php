<?php

namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Jeet\Chattle\app\Events\ChatUpdate;
use Jeet\Chattle\app\Models\Chat;
use Jeet\Chattle\app\Models\Message;

class GetMessagesController extends Controller
{
    public function __invoke(Request $request)
    {
        $messages = Message::where('chat_id', $request->chat_id)->orderBy('created_at', 'asc')->get();
        foreach($messages as $message){
            $message->is_seen = 1;
            $message->save();
        }
        $chats = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate();
        event(new ChatUpdate($chats));
        return response()->json($messages, 200);
    }
}
