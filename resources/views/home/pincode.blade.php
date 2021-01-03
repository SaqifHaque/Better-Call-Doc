<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pincode</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('log/images/icons/favicon.ico') }}" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/animate/animate.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/css-hamburgers/hamburgers.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/vendor/animsition/css/animsition.min.css') }}">
    
    
    <link rel="stylesheet" type="text/css" href="{{ asset('log/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('log/css/main.css') }}">
    <link href="{{ asset('dex/js/toastr.min.css') }}" rel="stylesheet">
    
</head>

<body>

    <div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset('log/css/main.css') }}');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
					Email Verification
				</span>
                <form action= "" method="POST" class="login100-form validate-form p-b-33 p-t-5">
                    @csrf
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input  class="input100" type="text" name="pincode" placeholder="Enter OTP" required>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn">
							Confirm
						</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('dex/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dex/js/toastr.min.js') }}"></script>
  <!-- Jquery JS-->
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

            let msg = "{{ $msg ?? ""}}";
            if (msg) {
                toastr["error"](msg)
            }
    </script>


</body>

</html>