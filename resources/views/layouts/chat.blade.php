<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Chatting System</title>
    
    
    <link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="{{asset('chat/css/style.css')}}">

    
    
    
  </head>

  <body>
<div class="header">
    <div class="container header-brand">
        <a href="{{url('/home')}}" class="brand">Chatting System</a>
    </div>
</div>
      <div class="container clearfix body">
   @include('partials.peoplelist')
    
    <div class="chat">
      <div class="chat-header clearfix">
        @if(isset($user))
            <img src="{{@$user->avatar}}" alt="avatar" />
        @endif
        <div class="chat-about">
            @if(isset($user))
                <div class="chat-with">{{'Chat with ' . @$user->name}}</div>
            @else
                <div class="chat-with">No Thread Selected</div>
            @endif
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      
      @yield('content')
      
      <div class="chat-message clearfix">
      <form action="" method="post" id="talkSendMessage">
            <textarea name="message-data" id="message-data" placeholder ="Nhập tin nhắn..." rows="3"></textarea>
            <input type="hidden" name="_id" value="{{@request()->route('id')}}">
            <button type="submit">Gửi</button>
      </form>

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->


      <script>
          var __baseUrl = "{{url('/')}}"
      </script>
    <script src='{{asset('libs/jquery/jquery.min.js')}}'></script>
    <script src='{{asset('libs/handlebars/handlebars.min.js')}}'></script>
    <script src='{{asset('libs/handlebars/list.min.js')}}'></script>



        <script src="{{asset('chat/js/index.js')}}"></script>
        <script src="{{asset('chat/js/talk.js')}}"></script>

    <script>
        var CURRENT_USER = {{ @$user->id }}
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
        }

        var msgshow = function(data) {
            if (data.sender.id !== CURRENT_USER) {
                // render chatlist
                activeUser = $(".active-user[data-user="+data.sender.id+"]")
                newsestMessage = activeUser.find(".newsest-message")
                newsestMessage.html(data.message.substring(0, 17)+ (data.message.length > 17 ? '...': ''))
            }
            else {
                // render current list
                var html = '<li id="message-' + data.id + '">' +
                    '<div class="message-data">' +
                    '<span class="message-data-name"> <a href="#" class="talkDeleteMessage" data-message-id="' + data.id + '" title="Delete Messag"><i class="fa fa-close" style="margin-right: 3px;"></i></a>' + data.sender.name + '</span>' +
                    '<span class="message-data-time">1 Second ago</span>' +
                    '</div>' +
                    '<div class="message my-message">' +
                    data.message +
                    '</div>' +
                    '</li>';

                $('#talkMessages').append(html);

                var objDiv = $('.chat-history');
                objDiv.scrollTop($('#talkMessages').height());
            }
        }

    </script>
    {!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}

  </body>
</html>
