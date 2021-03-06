
    <title>Better Call Doc</title>
@include('layout.navbar')
    <!-- Page Content -->
    <div>
        <div class="sliderAx h-auto">
            <div id="slider-1" class="container mx-auto">
                <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80)">
                    <div class="md:w-1/2">
                        <p class="font-bold text-sm uppercase">Services</p>
                        <p class="text-3xl font-bold">Hello world</p>
                        <p class="text-2xl mb-10 leading-none">Get Appointments now!!</p>
                        <a href="http://localhost:2020/userdash/contact" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
                    </div>
                </div>
                <!-- container -->
                <br>
            </div>

            <div id="slider-2" class="container mx-auto">
                <div class="bg-cover bg-top  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://blog.capterra.com/wp-content/uploads/2019/10/HEAD-Top_9_Medical_Apps_for_Doctors_Hero_no_text.png)">

                    <p class="font-bold text-sm uppercase">Welcome to</p>
                    <p class="text-3xl font-bold">Better Call Doc</p>
                    <p class="text-2xl mb-10 leading-none">Get Appointment from our best doctors</p>
                    <a href="#" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>

                </div>
                <!-- container -->
                <br>
            </div>
        </div>
        <div class="flex justify-between w-12 mx-auto pb-2">
            <button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2 "></button>
            <button id="sButton2" onclick="sliderButton2() " class="bg-purple-400 rounded-full w-4 p-2"></button>
        </div>
    </div>
    <div class="container">
        <div class="text-4xl sm:text-5xl text-center my-10">Our Top Doctors</div>

        <div id="doctor" class="grid md:grid-cols-3 gap-8 m-5 max-w-5xl m-auto">
        @forelse($doctors as $doc)
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
    <script>
        var cont = 0;

        function loopSlider() {
            var xx = setInterval(function() {
                switch (cont) {
                    case 0:
                        {
                            $("#slider-1").fadeOut(400);
                            $("#slider-2").delay(400).fadeIn(400);
                            $("#sButton1").removeClass("bg-purple-800");
                            $("#sButton2").addClass("bg-purple-800");
                            cont = 1;

                            break;
                        }
                    case 1:
                        {

                            $("#slider-2").fadeOut(400);
                            $("#slider-1").delay(400).fadeIn(400);
                            $("#sButton2").removeClass("bg-purple-800");
                            $("#sButton1").addClass("bg-purple-800");

                            cont = 0;

                            break;
                        }


                }
            }, 8000);

        }

        function reinitLoop(time) {
            clearInterval(xx);
            setTimeout(loopSlider(), time);
        }



        function sliderButton1() {

            $("#slider-2").fadeOut(400);
            $("#slider-1").delay(400).fadeIn(400);
            $("#sButton2").removeClass("bg-purple-800");
            $("#sButton1").addClass("bg-purple-800");
            reinitLoop(4000);
            cont = 0

        }

        function sliderButton2() {
            $("#slider-1").fadeOut(400);
            $("#slider-2").delay(400).fadeIn(400);
            $("#sButton1").removeClass("bg-purple-800");
            $("#sButton2").addClass("bg-purple-800");
            reinitLoop(4000);
            cont = 1

        }

        $(window).ready(function() {
            $("#slider-2").hide();
            $("#sButton1").addClass("bg-purple-800");
            loopSlider();
        });
    </script>
    <!-- <script>
        $("#navbar").load("../userdash/navbar");
    </script> -->


    <!-- <script type="text/javascript" src="Navbar.js"></script> -->
