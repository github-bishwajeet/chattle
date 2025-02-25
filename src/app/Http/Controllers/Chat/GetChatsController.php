<?php


namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Jeet\Chattle\app\Models\Chat;
use Illuminate\Http\Request;

class GetChatsController extends Controller
{
    public function __invoke(Request $request){
        if(auth()->check()){
            $user = auth()->user();
        }
        $chats = Chat::query();
        if(!empty($user) && $request->chat){
            $chats = $chats->where("email", $user->email)->latest()->first();
            if(!$chats){
                $chats = new Chat;
                $chats->name = $user->name;
                $chats->email = $user->email;
                $chats->last_sender = 'customer';
                $chats->unseen_messages = 0;
                $chats->save();
            }
        }else{
            $chats =$chats->withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate(10);
        }
        return response()->json($chats, 200);
    }
}
