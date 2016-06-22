<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Edume</title>

    <!-- Bootstrap -->
    <link href="{{asset('/')}}css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.min.css" rel="stylesheet">

    @yield('head')

    <link href="{{asset('/')}}css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    @include('partials.nav')
    @include('partials.alert')

    @yield('content')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/')}}js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.concat.min.js"></script>
    @yield('footer')
    <script>
    (function($){
        $(window).on("load",function(){
            $(".chat-list ul").mCustomScrollbar({
              theme:"green"
            });
        });
    })(jQuery);
    </script>
    @if (!Auth::guest())
    <script type="text/javascript">
      $('.chat-list .openChat .backChat').click(function(e) {
        
        $('.chat-list .openChat.open').removeClass('open');
        e.preventDefault();
      });

      $(document).on('click', '.chat-list .openChat .backChat', function(e) {
        $('.chat-list .openChat.open').removeClass('open');
        e.preventDefault();
      });

      $(document).on('click', '.chat-list .openChat .sendMessage button', function(e) {
        var userId = $(this).parents('.openChat').data('user-id');
        var parent = $(this).parent('.sendMessage');
        var message = parent.find("input").val();
        parent.find("input").val("");

        sendMessage(message, userId);
      });

      $( ".chat-list>ul li a" ).click(function(e) {
        var userId = $(this).data('user-id');
        closeOpenChats();

        if(!checkIfChatExist(userId))
        {
          var image = $(this).find('.media-object').attr('src');
          var name = $(this).find('.media-heading').html();
          createNewChat(userId, name, image);
        }
        else
        {
          showChatBox(userId);
        }

        e.preventDefault();
      });

      function closeOpenChats() {
        $('.chat-list .openChat.open').removeClass('open');
      }

      function checkIfChatExist(userId) {
        var chatBox = $('.chat-list .openChat[data-user-id="'+userId+'"]');

        if ( chatBox.length){
            return true;
        }
        return false;
      }
      function showChatBox(userId) {
        var chatBox = $('.chat-list .openChat[data-user-id="'+userId+'"]');
        chatBox.addClass('open');
      }

      function createNewChat(userId, name, image) {
        var chatBoxContent = `<div class="openChat open" data-user-id="`+ userId +`">
                                <div class="media">
                                  <div class="media-left">
                                    <a href="#" class="backChat"><span class="glyphicon glyphicon-menu-left"></span></a>
                                    <a href="#">
                                      <img class="media-object avatar" src="`+ image +`" alt="">
                                    </a>
                                  </div>
                                  <div class="media-body">
                                    <a href="#">
                                      <h4 class="media-heading">`+ name +`</h4>
                                    </a>
                                  </div>
                                </div> 
                                <hr>
                                <div class="messages">
                                  <table>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>  
                                <div class="sendMessage">
                                  <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter your message..">
                                  </div>
                                  <button type="button" class="btn btn-green">Send</button>
                                  <div class="clearfix"></div>
                                </div>               
                              </div>`;

        $('.chat-list').append(chatBoxContent);
      }

      var socket = io("127.0.0.1:3000");

      function sendMessage(message, userId) {
        var chatBox = $('.chat-list .openChat[data-user-id="'+userId+'"]');
        var table = chatBox.find(".messages table tbody");

        socket.emit('chat message', {message: message, to: userId
          , from: {{ Auth::user()->id }}
        });

        table.append('<tr><td><div class="me">'+ message +'</div></td></tr>');
      }


      function reciveMessage(message, userId) {
        closeOpenChats();
        $('.chat-list>ul li a[data-user-id="'+userId+'"]').click();

        var chatBox = $('.chat-list .openChat[data-user-id="'+userId+'"]');
        var table = chatBox.find(".messages table tbody");

        table.append('<tr><td><div class="you">'+ message +'</div></td></tr>');
      }

      socket.on('chat message', function(data){
        reciveMessage(data.message, data.from);
      });

      socket.emit('new user', {{Auth::user()->id}}, function(data){
          console.log(data);
      });
    </script>
    @endif

    <script type="text/javascript">
      // (function($){
        // var top = 0;
        // var p = $( ".chat-list" );
        // var position = p.position();
        // top = position.top;
        // alert(position.top);
        // $(window).on("scroll", function() {
        //   console.log(top);
        //     if($('.chat-list').length)
        //     {
        //       // var p = $( ".chat-list" );
        //       // var position = p.position();
        //       // top = position.top;
        //       if($(window).scrollTop() > top) {
        //         $(".chat-list").css("margin-top",($(window).scrollTop() - top));
        //         alert(top);
        //       } else {
        //           $(".chat-list").css("margin-top",0);
        //       }
        //     }
        // });
      // });

      (function($) {
        var element = $('.chat-list');
        if(element.length)
        {
          var originalY = element.offset().top;

          // Space between element and top of screen (when scrolling)
          var topMargin = 20;

          // Should probably be set in CSS; but here just for emphasis
          element.css('position', 'relative');

          $(window).on('scroll', function(event) {
              var scrollTop = $(window).scrollTop();

              element.stop(false, false).animate({
                  top: scrollTop < originalY
                          ? 0
                          : scrollTop - originalY + topMargin
              }, 50);
          });
        }
      })(jQuery);
    </script>

  </body>
</html>