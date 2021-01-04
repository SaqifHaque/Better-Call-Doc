<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Better Call Doc</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../../assets/Home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- Custom styles for this template -->
    <!-- <link href="../../assets/Home/css/heroic-features.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('dex/js/toastr.min.css') }}" rel="stylesheet">
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }
        
        body.modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }
    </style>

</head>

<body>   
    <form action="/takeappointment/{{ $doctor ->id }}" method="POST">
    @csrf
    <div class="flex p-4 space-x-4">
        <!-- <div>
            <img class="object-contain h-30 w-30" src="img_avatar.png" alt="..." class="object-cover h-48 w-full ...">
        </div> -->
        <div class="mb-4">
            <img class="w-auto mx-auto rounded-full object-cover object-center" src="https://i1.pngguru.com/preview/137/834/449/cartoon-cartoon-character-avatar-drawing-film-ecommerce-facial-expression-png-clipart.jpg" alt="Avatar Upload" />
        </div>
        <div class="space-y-4">
            <h4>Username:
                {{$doctor->name}}
            </h4>
            <br>
            <h4>Specialization:
            {{$doctor->specilization}}
            </h4>
            <br>
            <h4>Email:
            {{$doctor->email}}
            </h4>
            <br>
            <h4>availability:
            {{$doctor->availability}}
            </h4>
            <br>
            <h4>Time:
            {{$doctor->time}}
            </h4>
            <br>
            <h4>Visiting Cost:   
                    <span class="text-blue-600"> {{$doctor->charge}}</span>
            </h4>
            <br>
            <div class="rs-select2 js-select-simple select--no-search">
                <select id="date" name="date">
            <option name="date" value="" selected="selected">Choose Date</option>
            @foreach($availability as $d)
                <option value="{{ $d }}">{{ $d }}</option> 
               @endforeach
           
        </select>
                <select id="time" name="time">
            <option name="time" value="" selected="selected">Choose Time</option>
            @foreach($time as $t)
                <option value="{{ $t }}">{{ $t }}</option> 
                 @endforeach      
        </select>
                <div class="mt-8">
                    <button type="submit" class="modal-open inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <!-- Heroicon name: check -->
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Proceed Apointment
              </button>
                </div>
                <div class="py-4">
                    <p class="text-indigo-600 text-xl font-bold">
                        Rating:
                        @if($avg==0)
                            Not Rated
                        @else
                            {{ $avg }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <!-- reviews  -->

    </div>
</form>

    <!-- component -->
    @foreach($ratings as $r)
        <div class="flex items-start p-4">
            <div class="flex-shrink-0">
                <div class="inline-block relative">
                    <div class="relative w-16 h-16 rounded-full overflow-hidden">
                        <img class="absolute top-0 left-0 w-full h-full bg-cover object-fit object-cover" src="https://picsum.photos/id/646/200/200" alt="Profile picture">
                        <div class="absolute top-0 left-0 w-full h-full rounded-full shadow-inner"></div>
                    </div>
                    <svg class="fill-current text-white bg-green-600 rounded-full p-1 absolute bottom-0 right-0 w-6 h-6 -mx-1 -my-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M19 11a7.5 7.5 0 0 1-3.5 5.94L10 20l-5.5-3.06A7.5 7.5 0 0 1 1 11V3c3.38 0 6.5-1.12 9-3 2.5 1.89 5.62 3 9 3v8zm-9 1.08l2.92 2.04-1.03-3.41 2.84-2.15-3.56-.08L10 5.12 8.83 8.48l-3.56.08L8.1 10.7l-1.03 3.4L10 12.09z"/>
      </svg>
                </div>
            </div>
            <div class="ml-6">
                <p class="flex items-baseline">
                    <span class="text-indigo-600 font-bold text-xl">{{ $r->name}}</span>
                </p>
                <span class="text-gray-600 font-bold">{{ $r->rating }} out of 5</span>

            </div>


        </div>
        <div class="p-4">
            <span class="font-bold">Review

            </span>
            <p class="mt-1">
                {{ $r->review }}
            </p>
        </div>
        @endforeach 
                <!-- Bootstrap core JavaScript -->
                <!-- <script src="../../assets/Home/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/Home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                <script src="{{ asset('dex/vendor/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('dex/js/toastr.min.js') }}"></script>
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
                    </script>
</body>

</html>