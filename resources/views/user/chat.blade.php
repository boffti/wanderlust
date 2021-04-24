<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('scripts')
<script src="https://cdn.socket.io/4.0.1/socket.io.js"></script>
<script defer src="{{ URL::asset('js/chat.js') }}"></script>
@endsection

@section('title', 'WL | Chatroom')

@section('content')

    <div class="container">
        <h2>Chatroom</h2>
        <div class="hero-form card" style="overflow: hidden;">
            @csrf
            <div class="flex-left flex-wrap" style="justify-content: space-between;">
                <div class="form-control">
                    <input type="text" name="chatMessage" id="chatMessage"
                        placeholder="Type message">
                </div>
                <button id="sendMessage" class="btn">SEND</button>
            </div>

        </div>

        <div id="chats">

        </div>
    </div>

@endsection
