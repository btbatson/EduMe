<!doctype html>
<html>
  <head>
    <title>chat</title>
    <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }
      body { font: 13px Helvetica, Arial; }
      form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
      form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
      form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
      #messages { list-style-type: none; margin: 0; padding: 0; }
      #messages li { padding: 5px 10px; }
      #messages li.me { background: #eee; }
    </style>
  </head>
  <body>
    @if(Auth::user()->id == $chat->sender->id)
    <h1>{{ $chat->reciver->getName()}}</h1>
    @elseif(Auth::user()->id == $chat->reciver->id)
    <h1>{{ $chat->sender->getName()}}</h1>
    @endif
    <ul id="messages">
      @foreach($chat->messages as $message)
        <li class="{{ Auth::user()->id == $message->user_id ? 'me' : '' }}">{{$message->message}}</li>
      @endforeach
    </ul>
    <form action="">
      <input id="m" autocomplete="off" /><button>Send</button>
    </form>
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script>
      var socket = io("127.0.0.1:3000");


      $('form').submit(function(){
        socket.emit('chat message', {message: $('#m').val(), to: 
          @if(Auth::user()->id == $chat->sender->id)
          {{ $chat->reciver->id}}
          @elseif(Auth::user()->id == $chat->reciver->id)
          {{ $chat->sender->id}}
          @endif
          , from: {{ Auth::user()->id }}
          , chat_id : {{ $chat->id }}
        });

        $('#messages').append($('<li class="me">').text($('#m').val()));
        $('#m').val('');
        return false;
      });

      socket.emit('new user', {{Auth::user()->id}}, function(data){
          
        });

      socket.on('users', function(data){
        // var html = '';
        // for(i=0; i < data.length; i++){
        //   html += data[i] + '<br/>'
        // }
        // $users.html(html);
      });


      socket.on('chat message', function(data){
        $('#messages').append($('<li>').text(data.message));
      });
    </script>
  </body>
</html>