var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);

var fs = require('fs');
var path = require('path');

app.set('port', 3000);
app.use(express.favicon());
app.use(express.bodyParser());
app.use(express.static(path.join(__dirname, 'public')));

app.start = app.listen = function() {
    return server.listen.apply(server, arguments);
};

app.start(app.get('port'), function() {
    console.log('listening to http://localhost:3000');
});

function include( file_ ) {
    with( global ) {
        eval(fs.readFileSync(file_) + '');
    };
};

include(__dirname + '/config/include.js');
for ( var iCount = 0; iCount < servicefile.length; iCount++ ) {
    include(__dirname + '/service/' + servicefile[iCount]);
}

app.all('*', function(req, res, next) {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
    res.header('Access-Control-Max-Age', '3600');
    res.header('Access-Control-Allow-Headers', 'Origin,Accept,X-Requested-With,Content-Type,Access-Control-Request-Method,Access-Control-Request-Headers,Authorization');
    if (req.method == 'OPTIONS') {
        res.status(200).end();
    } else {
        next();
    }
});