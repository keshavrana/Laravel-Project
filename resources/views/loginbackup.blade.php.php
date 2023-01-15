<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
        <link href="{{ asset('assets/libs/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />

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
                                        <h5 class="text-muted text-uppercase py-3 font-16">Sign In</h5>
                                        <span id="time"></span>
                                        <br>
                                        @php
                                            $start = session()->get('last_time');
                                            $expire_time = session()->get('expire_time');
                                        @endphp
                                        <input type="text" id="start" value="{{$start}}">
                                        <input type="text" id="end" value="{{$expire_time}}">
                                        @if(Session::has('message'))
                                            <span class="text-danger">{{Session::get('message')}}</span>
                                        @endif
                                        @if(Session::has('success'))
                                            <span class="text-success">{{Session::get('success')}}</span>
                                        @endif

                                        @if(Session::has('time'))
                                        <span class="text-success">{{Session::get('time')}}</span>
                                        @endif
                                    </div>
    
                                    <form action="/login" method="post" class="mt-2">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="Enter your email">
                                            <span class="text-danger">
                                                @error('email')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="password" name="password" value="{{old('password')}}" id="password" placeholder="Enter your password">
                                            <span class="text-danger">
                                                @error('password')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="captcha">
                                                <span>{!! captcha_img() !!}</span>
                                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                                    &#x21bb;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                            <span class="text-danger">
                                                @error('captcha')
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit"> Log In </button>
                                        </div>

                                        <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
    
                                    </form>

                                    <div class="text-center mt-4">
                                        <h5 class="text-muted py-2"><b>Sign in with</b></h5>

                                        

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
                                <p class="text-white-50">Don't have an account? <a href="{{url('/')}}" class="text-white ml-1"><b>Sign Up</b></a></p>
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
        <script src="{{ asset('assets/libs/toastr/toastr.min.js')}}"></script>

        <script src="{{ asset('assets/js/pages/toastr.init.js')}}"></script>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

<script type="text/javascript">
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            toastr.options.closeButton = true;
            toastr.options.progressBar = true;
            @if(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif (Session::has('failed'))
                toastr.error('{{ Session::get('failed') }}');
            @endif
        });

        

        function diff_minutes(dt2, dt1) 
            {
                var diff =(dt2.getTime() - dt1.getTime()) / 1000;
                diff /= 60;
                return Math.abs(Math.round(diff));
            }

            dt1 = new Date();
            dt2 = new Date($('#end').val());
            var time = diff_minutes(dt1,dt2);
            $('#time').html(time);
            console.log(time);

            if(isNaN(time)){
            }
            else{
                var second = 59;
                var minutes = time-1;

                var timer = setInterval(() => {
                    if(minutes == 0 && second == 0){
                        clearInterval(timer);
                        $('#time').html('');
                        $('#start').val('');
                        $('#end').val('');
                    }
                    if(second <=0 ){
                        minutes--;
                        second = 60;
                    }
                $('#time').html(minutes+':'+second + ' Left Time');
                    second--;
                
                }, 1000);
            }

          

    </script>
        
    </body>
</html>