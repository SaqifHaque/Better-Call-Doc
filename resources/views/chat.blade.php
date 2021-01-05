<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('cha/css/app.css')}} ">
    <link rel="stylesheet" href="{{ asset('cha/css/chat.css')}} ">
    <style>
        .list-group{
            overflow-y: scroll;
            height:calc(100vh - 100px);
        }
        .text{
            margin: .2rem;
        }
    </style>
    <title>Messenger</title>
</head>
<body>
    <div class="container">
        <div class="flex"></div>
        <div class="flex border border-gray-300 rounded-lg" id="app">
            <li class="list-group-item bg-primary text-white">Private Chat <span class="text-white">(@{{numberOfUser}})</span></li>
            <ul class="list-group" v-chat-scroll>
               <message 
               v-for = "value,index in chat.message"
               :key = value.index
               color = primary
               :user = chat.user[index]
               :time = chat.time[index]
               >
                   @{{value}}
               </message>
              </ul>
              <li class="d-flex flex-row text-muted pb-2">@{{ typing }}</li>
            <input class="form-control" placeholder="Type a message..." v-model='message' @keyup.enter='send' autofocus>
        </div>
        <div class="flex"></div>
    </div>
    <script src="{{ asset('cha/js/app.js') }}"></script>
</body>
</html>