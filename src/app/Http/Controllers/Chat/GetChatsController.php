<?php


namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Jeet\Chattle\app\Models\Chat;
use Jeet\Http\Request;

class GetChatsController extends Controller
{
    public function __invoke(){
        $chats = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate(10);
        return response()->json($chats, 200);
    }
}
