<?php

namespace Jeet\Chattle\app\Http\Controllers\Chat;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Jeet\Chattle\app\Models\Chat;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $chats = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate();
        return view('chattle::admin.messages', [
            'chats' => $chats
        ]);
    }
}
