<?php

namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Jeet\Chattle\app\Events\ChatUpdate;
use Jeet\Chattle\app\Events\SendMessage;
use Jeet\Chattle\app\Models\Chat;
use Jeet\Chattle\app\Models\Message;

class PostMessageController extends Controller
{
    public function __invoke(Request $request)
    {
        $message = Message::create([
            'chat_id' => $request->chat_id,
            'type'    => 'text',
            'message' => $request->message,
            'is_seen' => 0,
            'sender'  => $request->sender
        ]);
        event(new SendMessage($message));
        if($message->sender == 'customer'){
            $chats = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate();
            event(new ChatUpdate($chats));
        }
        return response($message, 200);
    }
}
