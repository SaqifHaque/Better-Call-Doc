<!DOCTYPE html>
<html lang="en">
<title>Better Call Doc</title>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    
</head>


<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">



    <div class="p-4">
        <div class="md:flex">
            <form action="picupload/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="md:flex-shrink-0">
                    <div class="py-3 center mx-auto">
                        <div class="bg-white px-4 py-5 rounded-lg shadow-lg text-center w-60">
                            <div class="mb-4">
                                <img class="w-auto mx-auto rounded-full object-cover object-center" src="/uploads/profile-picture/{{ $user->profile_pic }}" alt="Avatar Upload" />
                            </div>
                            <label class="cursor-pointer mt-6">
                        <span class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full" >Upload Photo</span>
                        <input id="upload" type='file' class="hidden" name="dp"/>
                      </label>
                        </div>
                    </div>
                    <button id="up" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Update Profile Picture
                  </button>
                </div>
            </form>
            <form action="profile-edit/{{ $user->id }}" method="POST">
            @csrf
                <div class="mx-8 space-y-6">
                    <div>
                        <label for="username" class="text-indigo-600 font-bold">User Name:</label>
                        <input id="name" name="name" value="{{$user->name}}" type="text" class=" w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="text-indigo-600 font-bold">Email:</label>
                        <input id="email-address" value="{{$user->email}}" name="email" type="email" disabled class=" w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="bg" class="text-indigo-600 font-bold">Blood Group:</label>
                        <input id="bg" value="{{$user->blood_group}}" name="blood_group" type="text" disabled class=" w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="phone" class="text-indigo-600 font-bold">Phone Number:</label>
                        <input id="phone" value="{{$user->phone_number}}" name="phone" type="text" disabled class=" w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="text-indigo-600 font-bold">Password:</label>
                        <input id="pass" value="{{$user->password}}" name="password" type="password" class=" w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div class="flex flex-row-reverse">
                        <button id="btn" type="submit" class="bg-indigo-500 py-2 px-5 text-white rounded-sm">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $('#btn').on('click', function() {

            let name = document.getElementById("name").value;
            let pass = document.getElementById("pass").value;
            if (name == "") {
                toastr["error"]("Name Field Can be Empty")
            }
            if (pass == "") {
                toastr["error"]("Password Field Can be Empty")
            }
        })
        $('#up').on('click', function() {
            let fname = document.getElementById("upload").files.length;
            if (fname == 0) {
                toastr["error"]("You haven't chosen any pic")
            }

        })
    </script>


    <!-- <script type="text/javascript" src="Navbar.js"></script> -->

</body>

</html>