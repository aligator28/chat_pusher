<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="chat">
                    <ul id="chat_list" style="text-align: left">
                        @foreach($messages as $message)
                        <li>{{ $message->id }} {{ $message->content }}</li>
                        @endforeach
                    </ul>
                    <div class="user" id="user_field"></div>
                </div>
                <div class="form">
                    <form id="fff" method="post">
                        @csrf
                        <input type="text" name="message" id="message">
                        <input id="submit" type="submit" name="submit" value="Send">
                    </form>
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
{{--         <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 --}}        
        {{-- <script src="js/notifications.js"></script> --}}
        
        <script src="js/app.js"></script>
        
        <script type="text/javascript">
        $(document).ready(function() {

            // notifyMe();

            const form = $('#fff');
            const list = $('#chat_list');
            const txtfld = $('#message');
            const sbm = $('#submit');

            let user = {!! json_encode(Auth::user()); !!};
            let user_field = $('#user_field');
            
            const channel = window.Echo.private('mess');

            form.on('submit', function(e) {

                e.preventDefault();
                
                //disable submit button and write inside text field
                let mess = form.find("#message").val();
                sbm.attr('disabled', 'true');
                txtfld.val('Sending...');
                
                
                axios.post('/message', {
                    message: mess
                  })
                  .then(function (response) {
                    // console.log(response.data);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            });

            
            let laravel_messages = {!! json_encode($messages) !!};
            let max_message_id = Math.max.apply(
                Math, $.map(laravel_messages, function(o) {
                return o.id;
            }));

            $.each(laravel_messages, function(index, el) {
                console.log(el);                
            });

            //listen for channel and fill list of messages
            channel
                .listen('.message.sent', function(e) {
                    list.append('<li>' + (++max_message_id) + ' ' + e.chatMessage.content + '</li>');
                    sbm.removeAttr('disabled');
                    txtfld.val('');
                    list.find('li').first().remove();
            });

            
            txtfld.on('keydown', function(e) {
                channel.whisper('typ', {
                    //do whatever
                });
            });


            channel.listenForWhisper('typ', (e) => {
                user_field.text(user.name + ' is typing...');
                
                setTimeout(function() {
                  user_field.text('');
                }, 1500);
            });
        });

        </script>

    </body>
</html>
