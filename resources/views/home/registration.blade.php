<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registration Form</title>

    <!-- Icons font CSS-->
    <link href="{{ asset('dex/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="assets/dex/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ asset('dex/vendor/select2/select2.min.css" rel="stylesheet') }}" media="all">
    <link href="{{ asset('dex/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('dex/css/main.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dex/js/toastr.min.css') }}" rel="stylesheet">
</head>

<body>
<form action="/registration" method="POST">
@csrf
<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">User Name</label>
                                    <input id="uname" class="input--style-4" type="text" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input id="email" class="input--style-4" type="email" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <div class="input-group-icon">
                                        <input id="phone_number" class="input--style-4" type="text" name="phone_number" placeholder="+880-xxxxxxxxxxx" value="{{ old('phone_number') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="Male">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="Female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input id="pass" class="input--style-4" type="password" name="password">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input id="confpass" class="input--style-4" type="password" name="confirmpass">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Blood Group</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select id="bgroup" name="bloodgroup">
                                    <option value="" selected="selected">Choose option</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                <!-- <div class="select-dropdown"></div> -->
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button id="button" class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- Jquery JS-->
    <script src="{{ asset('dex/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Vendor JS-->
    <script src="{{ asset('dex/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dex/vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ asset('dex/vendor/datepicker/daterangepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('dex/js/global.js') }}"></script>
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
        let check = @json($errors);
        if(check.name)
        {
           toastr["error"](check.name); 
        }
        if(check.email){
           toastr["error"](check.email);
        }
        if(check.bloodgroup){
           toastr["error"](check.bloodgroup);
        }
        if(check.phone){
           toastr["error"](check.phone);
        }
        if(check.password){
           toastr["error"](check.password);
        }
        if(check.confirmpass){
            toastr["error"](check.confirmpass);
        }
    </script>

</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->