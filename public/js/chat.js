jQuery(document).ready(function ($) {

    // Create Socket Connection for Heroku
    const socket = io('https://wl-chat.herokuapp.com/');

    var room_id;
    socket.on('connect', function () {
        $.ajax({
            url: '/get-room-id',
            type: 'get',
            success: function (response) {
                room_id = response['city_name'];
                // console.log(room_id);
                socket.emit('room_id', room_id);
            },
        });
    });

    // Subscribe to messages pushed my Socket Server
    socket.on('message', text => {
        var chat = ` <div class="card post">
    <div class="flex-left">
        <img class="postIMG" src="https://wanderlust-axm.herokuapp.com/upload/user_dp/${text['dp']}" alt="avatar">
        <div class="full-width">
            <div class="flex-left space-between align-items-center">
                <a target="_blank" href="https://wanderlust-axm.herokuapp.com/user/${text['user_id']}">
                    <h4 class="">${text['full_name']}</h4>
                </a>
                <p class="post-date"></p>
            </div>
            <p class="post-content">${text['message']}</p>
        </div>
    </div>
</div>`
        $('#chats').append(chat);
    });

    // Emit messages to Socket Server
    $('#sendMessage').on('click', function () {
        const text = $('#chatMessage').val();
        $('#chatMessage').val('');
        // var user;
        $.ajax({
            url: '/en/send-chat/' + text,
            type: 'get',
            data: text,
            success: function (response) {
                var data = response;
                data['message'] = text;
                // console.log(data);
                console.log(room_id);
                // write chat message to DB
                socket.emit('message', room_id, data);
            },
        });

    });

});
