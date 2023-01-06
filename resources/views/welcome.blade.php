<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />

        <style>
            #captcha_area{
                text-align: center;
                font-size: 20px;
                background-image: url('assets/images/captcha-bg.png');
                background-repeat: no-repeat;
                background-size: cover;
                padding: 8px;
            }
            #captcha_area label{
                font-size: 20px;
            }
        </style>
    </head>

    <body class="authentication-bg">

        <div class="account-pages pt-5 my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="account-card-box">
                            <div class="card mb-0">
                                <div class="card-body p-4">
                                    
                                    <div class="text-center">
                                        <div class="my-3">
                                            <a href="index.html">
                                                <span><img src="{{ url('assets/images/logo.png')}}" alt="" height="28"></span>
                                            </a>
                                        </div>
                                        <h5 class="text-muted text-uppercase py-3 font-16">Sign up</h5>
                                    </div>
    
                                    <form action="{{url('/register')}}" method="post" onsubmit="return upload(this);" class="mt-2">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="email" name="email" placeholder="Enter your email">
                                            <span class="text-danger">
                                                @error('email')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="text" name="user_name" placeholder="Enter your username">
                                            <span class="text-danger">
                                                @error('user_name')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                            <span class="text-danger">
                                                @error('password')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                        <input type="hidden" id="firstnumber">
                                        <input type="hidden" id="secondnumber">

                                        <div class="row" >
                                            <div class="form-group col-sm-8 mb-3">
                                                <div id="captcha_area">
                                                    <label id="fnum"></label> +
                                                    <label id="snum"></label> =
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-4 mb-3">
                                                <button class="btn btn-dark refresh">Refresh</button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="number" id="captcha" name="captcha" placeholder="Enter Capcta">
                                            <div id="captcha_error"></div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit"> Join Now </button>
                                        </div>
    
                                    </form>

                                    <div class="text-center mt-4">
                                        <h5 class="text-muted py-2"><b>Sign up with</b></h5>

                                        <div class="row">
                                            <div class="col-12">
                                                <a href="/sign-in/github">
                                                <button type="button" class="btn btn-github waves-effect font-14 waves-light mt-3">
                                                    <i class=" fab fa-github mr-1"></i> Github
                                                </button>
                                                </a>
                                                <a href="/sign-in/google">
                                                <button type="button" class="btn btn-googleplus waves-effect font-14 waves-light mt-3">
                                                    <i class="fab fa-google-plus-g mr-1"></i> Google+
                                                </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
    
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account? <a href="/login" class="text-white ml-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js')}}"></script>
        
    </body>

    <script>
        function upload(){
            $('#captcha_error').html('');
            let fnum = $('#firstnumber').val();
            let snum = $('#secondnumber').val();

            let sum = parseInt(fnum) + parseInt(snum);
            let inputval = $('#captcha').val();
            if(inputval == null || inputval == ""){
                $('#captcha_error').append("<span class='text-danger'>Please Enter Valid Captcha</span>");
                return false;
            }
            else if(parseInt(sum) == parseInt(inputval)){
                return true;
            }
            else{
                $('#captcha_error').append("<span class='text-danger'>Wrong Answer</span>");
                return false;
            }
            
            }
        $(document).ready(function(){
            let firstnum = Math.floor((Math.random() * 10));
            let secondnum = Math.floor((Math.random() * 10));
            $('#fnum').html(firstnum);
            $('#snum').html(secondnum);
            $('#firstnumber').val(firstnum);
            $('#secondnumber').val(secondnum);
        

            function randomGenerate(){
            $('#captcha_error').html('');
            $('#captcha').val('');
            let firstnum = Math.floor((Math.random() * 10));
            let secondnum = Math.floor((Math.random() * 10));
            $('#fnum').html(firstnum);
            $('#snum').html(secondnum);
            $('#firstnumber').val(firstnum);
            $('#secondnumber').val(secondnum);
            }

            $('.refresh').click(function(e){
                e.preventDefault();
                randomGenerate();
            });

            

            
        });
    </script>
</html>