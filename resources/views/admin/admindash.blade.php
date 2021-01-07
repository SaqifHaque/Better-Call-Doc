<title>Admin Dashboard</title>
@extends('layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
        integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

    <div class="flex flex-col bg-white">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-t-3xl bg-blue-400 p-4 shadow text-2xl text-white">
                <h3 class="font-bold pl-2">Analytics</h3>
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                    class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Total Revenue</h5>
                            <h3 class="font-bold text-3xl">${{$rev}} <span class="text-green-500"><i
                                        class="fas fa-caret-up"></i></span></h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Total Users</h5>
                            <h3 class="font-bold text-3xl">{{ $user }}<span class="text-pink-500"><i
                                        class="fas fa-exchange-alt"></i></span></h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a href="/user/new">

                    <div
                        class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-yellow-600"><i
                                        class="fas fa-user-plus fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Add User</h5>

                            </div>

                        </div>
                    </div>
                </a>

                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a href="/users">
                    <div
                        class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">View Users</h5>
                                <h3 class="font-bold text-3xl"></h3>
                            </div>
                        </div>
                    </div>
                </a>

                <!--/Metric Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <a href="/appointment">
                    <!--Metric Card-->
                    <div
                        class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-tasks fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Appoinments List</h5>
                                <h3 class="font-bold text-3xl">{{ $app }} tasks</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </a>

            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <a href="/appointment-list">
                    <!--Metric Card-->
                    <div
                        class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-red-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Appoinments</h5>
                                <h3 class="font-bold text-3xl">{{ $tapp }} <span class="text-red-500"><i
                                            class="fas fa-caret-up"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </a>

            </div>
        </div>


        <div class="flex flex-row flex-wrap flex-grow mt-2">
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Graph Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div
                        class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Appointments</h5>
                    </div>
                    <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                        <script>
                            new Chart(document.getElementById("chartjs-4"), {
                                "type": "doughnut",
                                "data": {
                                    "labels": ["Cancelled", "Pending", "Completed"],
                                    "datasets": [{
                                        "label": "Issues",
                                        "data": [{{ $can }}, {{ $app }}, {{ $com }}],
                                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)",
                                            "rgb(255, 205, 86)"
                                        ]
                                    }]
                                }
                            });

                        </script>
                    </div>
                </div>
                
                <!--/Graph Card-->
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Graph Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div
                        class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">User Ratio</h5>
                    </div>
                    <div class="p-5"><canvas id="chartjs-6" class="chartjs" width="undefined" height="undefined"></canvas>
                        <script>
                            new Chart(document.getElementById("chartjs-6"), {
                                "type": "doughnut",
                                "data": {
                                    "labels": ["Admin", "Doctor", "User"],
                                    "datasets": [{
                                        "label": "Issues",
                                        "data": [{{$admin }}, {{ $doctor }}, {{ $patient }}],
                                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)",
                                            "rgb(255, 205, 86)"
                                        ]
                                    }]
                                }
                            });

                        </script>
                    </div>
                </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Graph Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div
                        class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">finance</h5>
                    </div>
                    <div class="p-5"><canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                        <script>
                            new Chart(document.getElementById("chartjs-7"), {
                                "type": "doughnut",
                                "data": {
                                    "labels": ["Admin", "Doctor"],
                                    "datasets": [{
                                        "label": "Issues",
                                        "data": [{{$cost }}, {{ $profit }}],
                                        "backgroundColor": ["rgb(255, 99, 132)", 
                                            "rgb(255, 205, 86)"
                                        ]
                                    }]
                                }
                            });

                        </script>
                    </div>
                </div>
                </div>
                <!--Table Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div
                        class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h5 class="font-bold uppercase text-gray-600 text-xl text-bold">Post Notice</h5>
                    </div>
                    <div class="p-2">
                        <form action="/noti" method="POST">
                            @csrf
                            <textarea name="details" class="w-full" id="" rows="5"></textarea>
                            <div class="flex flex-row-reverse my-4">
                                <button type="submit" class="bg-blue-300 py-2 px-5 rounded-lg">Post
                                    Notice</button>
                        </form>
                    </div>
                </div>
            
            <!--/table Card-->
                
                <!--/Graph Card-->
            </div>
            </div>
            </div>
    </div>


</head>
    @endsection
            <script async type="text/javascript"
                        src="//cdn.carbonads.com/carbon.js?serve=CK7D52JJ&placement=wwwtailwindtoolboxcom"
                        id="_carbonads_js"></script>
                        <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }

    </script>
