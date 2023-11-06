@include("dash_cut/login_header")

    <!-- <div class="home-btn d-none d-sm-block">
        <a href="/" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                
                                <p class="text-white-50">Sign in to continue to WVS.</p>
                                <a href="{{url('/dashboard')}}" class="logo logo-admin">
                                    <img src="{{ url('dashboard_assets/images/logo-sm.png') }}" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                @if(Session::has("msg"))
                                <h5 class="font-size-20" style="color:red;text-align:center;">{{Session::get("msg")}}</h5>
                                @endif
                                <form class="mt-4" action="{{url('/checkuser')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" name="pass" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customControlInline">
                                                <label class="form-check-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div> -->

<body class="account-pages">
    <!-- Begin page -->
    <div class="accountbg" style="background: url('{{ url('dashboard_assets/images/bg_water2.jpg') }}');background-size: cover;background-position: center;"></div>
        <div class="wrapper-page account-page-full" style="background-color: #ffffffe3!important;">
            <div class="card shadow-none"style="background-color: #ffffff00;">
                <div class="card-block">
                    <div class="account-box">
                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="/" style="font-size:40px;font-weight: 600;letter-spacing: 4px;"><img src="{{ url('dashboard_assets/images/loginicon.png') }}" height="200" alt="logo"><!--WVS--></a>
                                </div>
                                <h4 class="font-size-18 mt-2 text-center" style="color:black!important">Welcome Back !</h4>
                                <p class="text-muted text-center" style="color:black!important">Sign in to continue to WVS.</p>
                                @if(Session::has("msg"))
                                <h5 class="font-size-20" style="color:red;text-align:center;">{{Session::get("msg")}}</h5>
                                @endif
                                <form class="mt-4" action="{{url('/checkuser')}}" method="post">
                                    @csrf
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label" for="email" style="color:black!important">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword" style="color:black!important">Password</label>
                                        <input type="password" name="pass" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div>
    
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                                <!-- <div class="mb-3 mt-2 mb-0 row">
                                    <div class="col-12 mt-3">
                                        <a href="pages-recoverpw-2.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div> -->

                            </form>

                    @include("dash_cut/login_footer")