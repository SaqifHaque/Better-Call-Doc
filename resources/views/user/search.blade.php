<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Better Call Doc</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/Home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <!-- <link href="assets/Home/css/heroic-features.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('dex/js/toastr.min.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="text-4xl sm:text-5xl text-center my-10">Our Top Doctors</div>

        <div id="doctor" class="grid md:grid-cols-3 gap-8 m-5 max-w-5xl m-auto">
            @if($doctors)
        @foreach($doctors as $doc)
                <div class="transition duration-500 ease-in-out bg-white rounded shadow-md transform hover:-translate-y-1 hover:scale-110 ...">
                    <img src="{{$doc->profile_pic}}" alt="" class="w-full h-48 sm:h-56 object-cover" />

                    <div class="px-10 py-6 mb-10 text-center">
                        <div class="text-2xl font-bold text-purple-500 mb-4">
                                {{$doc->name}}
                        </div>
                        <span class="text-sm">
                        {{$doc->specilization}}
                    
                            </span>
                        <br>
                        <span class="text-sm">{{$doc->email}}</span>
                        <br>
                        <span class="text-sm">{{$doc->qualification}}</span>
                        <br>
                        <span class="text-sm">{{$doc->availability}}</span>
                        <!-- <br>
                            <span class="text-sm"><%= sub.email %></span> -->
                    </div>
                    <button onclick="window.location.href='{{route('user.doctor', $doc->id)}}'" class="transition duration-500 ease-out-in w-full text-lg h-16 text-white font-extrabold bg-purple-700 hover:w-full text-lg h-16 text-white font-extrabold bg-red-400 transform hover:-translate-y-1 hover:scale-110 ...">Take Appointment</button>
                </div>
                @endforeach
                @else
                        <p>No Serch Result Found.</p>
                @endif
        </div>
        </main>

        <!-- Page Features -->


    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('dex/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dex/js/toastr.min.js') }}"></script>

</body>

</html>