var socket_ids = [];
var count = 0;

function loginUser(socket, nickname){
    socket_ids[nickname] = socket.id;
}

io.sockets.on('connection', function( socket ) {
    // 해당 유저의 닉네임과 고유 소켓 번호 저장
    socket.on('enter:main', function( data ) {
        loginUser(socket, data.user);
        count++;
        console.log(socket_ids);
    });

    // 특정 캠프의 채팅방에 입장
    socket.on('enter:camp', function( data ) {
        socket.join(data.roomname);
        socket.roomnum = data.roomname;
        console.log(io.sockets.adapter.rooms);
        console.log(socket.id);
        console.log(socket_ids);

        io.sockets.in(data.roomname).emit('enter:camp', {from: data.user});
/*
        io.sockets.emit('roomlist', {
            "roomdata":io.sockets.adapter.rooms,
            "clientid":socket.id,
            "roomname":data.roomname,
            "nickname":data.nickname
        });
*/
    });

    socket.on('send:message', function( data ) {
        io.sockets.to(data.roomname).emit('receive:message', {'from': data.user, 'message': data.message});
    });

    socket.on('message', function( data ) {
        io.sockets.to(data.roomname).emit('message_send', {'msg':data.msg, 'from':data.nickname});
    });

    socket.on('roomleave', function( data ) {
        io.sockets.to(data.roomname).emit('message_send_disconnect', {'msg':'', 'from':data.nickname});
        io.sockets.to(data.roomname).emit('room_research', null);
        socket.leave(data.roomname);
        console.log(io.sockets.adapter.rooms);
    });

    socket.on('disconnect', function() {
        io.sockets.emit('room_research', null);
    });

    // 특정 방 입장

    // 입장한 방 나가기
});