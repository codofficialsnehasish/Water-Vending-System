<!-- adding header -->
@include("dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Dashboard</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to WVS Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showuser')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/06.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Users</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$users}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                                <!-- <div class="mini-stat-label bg-success">
                                                    <p class="mb-0">+ 12%</p>
                                                </div> -->
                                                <!-- <div class="float-end">
                                                    <a href="{{url('/showuser')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div> -->
                                            </div>
                                            <!-- <div class="pt-2">
                                                <div class="float-end">
                                                    <a href="{{url('/showuser')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div>
                                                <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showcustomer')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/05.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Customers</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$customer}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                                <!-- <div class="mini-stat-label bg-success">
                                                    <p class="mb-0">+ 12%</p>
                                                </div> -->
                                            </div>
                                            <!-- <div class="pt-2">
                                                <div class="float-end">
                                                    <a href="{{url('/showcustomer')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div>
                                                <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/show_bill')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/07.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Bills</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$bill}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                                <!-- <div class="mini-stat-label bg-success">
                                                    <p class="mb-0">+ 12%</p>
                                                </div> -->
                                            </div>
                                            <!-- <div class="pt-2">
                                                <div class="float-end">
                                                    <a href="{{url('/show_bill')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div>
                                                <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/showexp')}}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/08.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Expences</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{$exp}} <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                                <!-- <div class="mini-stat-label bg-success">
                                                    <p class="mb-0">+ 12%</p>
                                                </div> -->
                                            </div>
                                            <!-- <div class="pt-2">
                                                <div class="float-end">
                                                    <a href="{{url('/showexp')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div>
                                                <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{url('/send_bill')}}">
                                        <div class="card-body">
                                            <div class="">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ url('dashboard_assets/images/services-icon/09.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Send Bill</h5>
                                                <h1 class="fw-medium font-size-30 text-white-50" style="color:white!important;">{{$bs}}<i class="mdi mdi-arrow-right text-success h1"></i></h1>
                                                <!-- <div class="mini-stat-label bg-success">
                                                    <p class="mb-0">+ 12%</p>
                                                </div> -->
                                            </div>
                                            <!-- <div class="pt-2">
                                                <div class="float-end">
                                                    <a href="{{url('/showexp')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                </div>
                                                <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                            </div> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                <!-- End Page-content -->

                
                @include("dash/footer")