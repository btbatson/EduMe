var request = require('request');
var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

users = {};

redis.subscribe('test-channel');

redis.on('message', function(channel, message){
	console.log(channel);
	console.log(message);
});

io.on('connection', function(socket){

	socket.on('new user', function(data, callback){
		if (data in users){
			callback(false);
		} else{
			callback(true);
			socket.id = data;
			users[socket.id] = socket;
			updateUsers();
		}
	});
	console.log('new user');
  socket.on('chat message', function(msg){
    // io.emit('chat message', msg);
    users[msg.to].emit('chat message', msg);
    console.log(msg);

	var options = {
	    url: 'http://localhost/Edume/public/server/chat/message',
	    method: 'POST',
	    qs: {'message': msg.message, 'to': msg.to, 'from': msg.from, 'chat_id': msg.chat_id}
	}
	 
	// Start the request
	request(options, function (error, response, body) {
	    if (!error && response.statusCode == 200) {
	        // Print out the response body
	        console.log(body)
	    }
	});
  });

  function updateUsers(){
		io.sockets.emit('users', Object.keys(users));
		console.log(users);
	}

  socket.on('disconnect', function(data){
		if(!socket.id) return;
		delete users[socket.id];
		updateUsers();
	});

});

server.listen(3000);