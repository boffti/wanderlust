<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\GeneralChat;

class ChatController extends Controller
{
    public function getChat($locale, $room_id) {
        $chats = Chat::where('room_id', $room_id)
        ->with('user')
        ->orderBy('created_at', 'ASC')
        ->take(20)
        ->get();
        return view('user/chat')
        -> with('chats', $chats);
    }

    public function getGeneralChat() {
        $chats = GeneralChat::with('user')
        ->orderBy('created_at', 'ASC')
        ->take(50)
        ->get();
        return view('user/general_chat')
        -> with('chats', $chats);
    }

    public function sendChat(Request $request, $locale, $msg) {
        $c = new Chat;
        $c -> user_id = session('user')['user_id'];
        $c -> message = $msg;
        $c -> room_id = session('user_loc')['city_id'];
        $c->save();
        return session('user');
    }

    public function getRoomId() {
        return session('user_loc');
    }

}
