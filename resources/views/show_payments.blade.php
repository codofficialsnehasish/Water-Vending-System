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
                                    <h6 class="page-title">Payments</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Payments</li>
                                    </ol>
                                </div>
                                @if(Auth::user()->role == "Admin")
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/payment')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Total Balance</th>
                                                    <th>Paid Amount</th>
                                                    <th>Mode</th>
                                                    <!-- <th>Recipt</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $d)
                                                <tr>
                                                    <td>{{$d->date}}</td>
                                                    <td>{{$d->name}}</td>
                                                    <td>{{$d->previous_balance}}</td>
                                                    <td>{{$d->paid_amount}}</td>
                                                    <td>{{$d->payment_mode}}</td>
                                                    <!-- <td><a href="{{url('/recipt')}}" class="btn btn-success">View Recipt</a></td> -->
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")