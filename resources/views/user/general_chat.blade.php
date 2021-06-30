<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('scripts')
<script src="https://cdn.socket.io/4.0.1/socket.io.js"></script>
<script defer src="{{ URL::asset('js/chat.js') }}"></script>
@endsection

@section('title', 'Global Chatroom')

@section('content')

    <div class="container">
        <div class="flex-left" style="justify-content: space-between;">
            <h2>{{ __("Chatroom") }}</h2>
        </div>
        <div id="chats">

            @if(isset($chats))
            @foreach($chats as $chat)
            <div class="card post">
                <div class="flex-left">
                    <img class="postIMG" src="{{ URL::asset('upload/user_dp/') }}/{{ $chat['user']['dp'] }}" alt="">
                    <div class="full-width">
                        <div class="flex-left space-between align-items-center">
                            <a target="_blank" href="/user/{{ $chat['user']['user_id'] }}">
                                <h4 class="">{{ $chat['user']['full_name'] }}</h4>
                            </a>
                            <p class="post-date"></p>
                        </div>
                        <p class="post-content">{{ $chat['message'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        <div class="hero-form card sticky" style="overflow: hidden;">
            @csrf
            <div id="chatTextBox" class="flex-left flex-wrap" style="justify-content: space-between;">
                <div class="form-control">
                    <input type="text" name="chatMessage" id="chatMessage"
                        placeholder="Type message" style="width: 800px">
                </div>
                <button id="sendMessage" class="btn btn-primary"><i class="fas fa-paper-plane" style="margin-right: 7px"></i> {{ __("SEND") }}</button>
            </div>
        </div>
    </div>

@endsection

@section('chat_script')
<script src="{{ URL::asset('js/chat.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {

    });
</script>
@endsection
