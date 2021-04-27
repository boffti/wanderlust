
const http = require('http').createServer();

const io = require('socket.io')(http, {
    cors: { origin: "*" }
});

io.on('connection', (socket) => {
    console.log('a user connected');

    socket.on('room_id', function(room_id) {
        console.log(room_id);
        socket.join(room_id);
    });

    socket.on('message', (room, message) =>     {
        // console.log(message);
        io.to(room).emit('message', message );
    });
});

http.listen(8080, () => console.log('listening on http://localhost:8080') );


// Regular Websockets

// const WebSocket = require('ws')
// const server = new WebSocket.Server({ port: '8080' })

// server.on('connection', socket => {

//   socket.on('message', message => {

//     socket.send(`Roger that! ${message}`);

//   });

// });



