app.get('/roomlist', function( req, res ) {
    res.send({roomdata:io.sockets.adapter.rooms});
});