<?php


namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Jeet\Chattle\app\Models\Chat;
use Illuminate\Http\Request;

class GetChatsController extends Controller
{
    public function __invoke(Request $request){
        if(auth()->check()){
            $email = auth()->user()->email;
        }
        $chats = Chat::query();
        if(!empty($email) && $request->chat){
            $chats = $chats->where("email", $email)->latest()->first();
        }else{
            $chats =$chats->withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate(10);
        }
        return response()->json($chats, 200);
    }
}
