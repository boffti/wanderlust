<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function getChat() {
        $chats = Chat::with('user')
        ->orderBy('created_at', 'ASC')
        ->take(20)
        ->get();
        return view('user/chat')
        -> with('chats', $chats);
    }

    public function sendChat(Request $request, $msg) {
        $c = new Chat;
        $c -> user_id = session('user')['user_id'];
        $c -> message = $msg;
        $c->save();
        return session('user');
    }

}
