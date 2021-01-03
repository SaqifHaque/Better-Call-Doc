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
    <link href="../../assets/Index/js/toastr.min.css" rel="stylesheet">
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
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    </nav>
    <div class="flex p-4 space-x-4">
        <!-- <div>
            <img class="object-contain h-30 w-30" src="img_avatar.png" alt="..." class="object-cover h-48 w-full ...">
        </div> -->
        <div class="mb-4">
            <img class="w-auto mx-auto rounded-full object-cover object-center" src="https://i1.pngguru.com/preview/137/834/449/cartoon-cartoon-character-avatar-drawing-film-ecommerce-facial-expression-png-clipart.jpg" alt="Avatar Upload" />
        </div>
        <div class="space-y-4">
            <h4>Username:
                {{$doctor[0]->name}}
            </h4>
            <br>
            <h4>Specialization:
            {{$doctor[0]->specilization}}
            </h4>
            <br>
            <h4>Email:
            {{$doctor[0]->email}}
            </h4>
            <br>
            <h4>availability:
            {{$doctor[0]->availability}}
            </h4>
            <br>
            <h4>Time:
            {{$doctor[0]->time}}
            </h4>
            <br>
            <h4>Visiting Cost:   
                    <span class="text-blue-600"> {{$doctor[0]->charge}}</span>
            </h4>
            <br>
            <div class="rs-select2 js-select-simple select--no-search">
                <select id="date" name="date">
            <option name="date" value="" selected="selected">Choose Date</option>
            <% for(const d of date){ %>
                <option value="<%= d %>"><%= d %></option> 
                <% } %>
           
        </select>
                <select id="time" name="time">
            <option name="time" value="" selected="selected">Choose Time</option>
            <% for(const t of time){ %>
                <option value="<%= t
                 %>"><%= t %></option> 
                <% } %>       
        </select>
                <div class="mt-8">
                    <button id="button" type="button" class="modal-open inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                        <%= avg %>

                    </p>
                </div>
            </div>
        </div>
        <!-- reviews  -->

    </div>
    <!-- component -->
    <% for(const r of reviews){ %>
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
                    <span class="text-indigo-600 font-bold text-xl"><%= r.username %></span>
                </p>
                <span class="text-gray-600 font-bold"><%= r.rating %> out of 5</span>

            </div>


        </div>
        <div class="p-4">
            <span class="font-bold">Review

            </span>
            <p class="mt-1">
                <%= r.review %>
            </p>
        </div>
        <% } %>
            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                    </div>

                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Proceed Payment</p>
                            <div onclick="toggleModal()" class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                            </div>
                        </div>

                        <!--Body-->
                        <form method="POST">
                            <label for="">Appoinment Date</label>
                            <input id="ap_date" name="app_date" type="text" class="w-full shadow-sm" readonly>
                            <label for="">Appoinment Time</label>
                            <input id="ap_time" name="app_time" type="text" class="w-full shadow-sm" readonly>
                            <label for="">Visiting Cost</label>
                            <input name="cost" type="text" class="w-full shadow-sm" value="<%=charge%>" readonly>

                            <% if(status != "check"){ %>
                                <span class="text-gray-700 mt-2">Payment Type</span>
                                <div class="mt-2">
                                    <div id="myRadioGroup" class="space-x-4">
                                        <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="cash" checked="checked" value="bkash" />
                                <span class="ml-2">Bkash</span>
                            </label>
                                        <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="cash" value="cash" />
                                <span class="ml-2">Cash on check up</span>
                            </label>

                                        <div class="mt-2">
                                            <div id="cashbkash" class="desc">
                                                Pay On XXX-XXX-XXX-XX then provide the bkash transaction Id.
                                                <input id="tran" name="tran" type="text" class="w-full shadow-sm bg-gray-100"> </div>
                                            <div id="Cars3" class="desc" style="display: none;">
                                                <!-- Cash on check up -->
                                            </div>
                                        </div>
                                    </div>
                                    <%  } %>

                                        <!--Footer-->
                                        <div class="flex justify-end pt-2">
                                            <button id="btn" type="submit" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Proceed</button>
                                        </div>

                                </div>
                        </form>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript -->
                <!-- <script src="../../assets/Home/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/Home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                <script src="https://code.jquery.com/jquery-3.2.1.min.js "></script>
                <script src="../../assets/Index/js/toastr.min.js"></script>
                <script>
                    $("#navbar").load("../navbar");
                </script>
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
                    var openmodal = document.querySelectorAll('.modal-open')
                    for (var i = 0; i < openmodal.length; i++) {
                        openmodal[i].addEventListener('click', function(event) {
                            event.preventDefault()
                            if (document.getElementById("date").value != "" && document.getElementById("time").value != "") {
                                document.getElementById("ap_date").value = document.getElementById("date").value;
                                document.getElementById("ap_time").value = document.getElementById("time").value;
                                toggleModal()
                            }
                        })
                    }

                    const overlay = document.querySelector('.modal-overlay')
                    overlay.addEventListener('click', toggleModal)

                    var closemodal = document.querySelectorAll('.modal-close')
                    for (var i = 0; i < closemodal.length; i++) {
                        closemodal[i].addEventListener('click', toggleModal)
                    }

                    document.onkeydown = function(evt) {
                        evt = evt || window.event
                        var isEscape = false
                        if ("key" in evt) {
                            isEscape = (evt.key === "Escape" || evt.key === "Esc")
                        } else {
                            isEscape = (evt.keyCode === 27)
                        }
                        if (isEscape && document.body.classList.contains('modal-active')) {
                            toggleModal()
                        }
                    };


                    function toggleModal() {
                        const body = document.querySelector('body')
                        const modal = document.querySelector('.modal')
                        modal.classList.toggle('opacity-0')
                        modal.classList.toggle('pointer-events-none')
                        body.classList.toggle('modal-active')
                    }
                    document.getElementById("")
                    $('#button').on('click', function() {
                        let time = document.getElementById("time").value;
                        let date = document.getElementById("date").value;
                        if (time == "") {
                            toastr["error"]("Please,Set time Of appointment")
                        }
                        if (date == "") {
                            toastr["error"]("Please,Set date Of appointment")
                        }

                    })
                    $('#btn').on('click', function() {
                        var tran = document.getElementById("tran").value;
                        if (tran == "" || tran.length < 10) {
                            toastr["error"]("Please,Provide valid transaction Id")
                        }
                    })
                </script>
                <script>
                    $(document).ready(function() {
                        $("input[name$='cash']").click(function() {
                            var test = $(this).val();

                            $("div.desc").hide();
                            $("#cash" + test).show();
                        });
                    });
                </script>

</body>

</html>