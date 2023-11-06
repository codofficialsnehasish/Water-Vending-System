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
                                    <h6 class="page-title">Bills</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Bills</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/bill')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                @if(Session::has("mssg"))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Success!</strong> {{Session::get("mssg")}}
                                </div>
                                @endif
                                @if(Session::has("mssgg"))
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Error!</strong> {{Session::get("mssgg")}}
                                </div>
                                @endif
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Current Unit</th>
                                                    <th>Previous Unit</th>
                                                    <th>Difference</th>
                                                    <th>
                                                        @php 
                                                            $currentMonth = date('F');
                                                            echo Date('F', strtotime($currentMonth . " last month"));
                                                        @endphp
                                                        Bill
                                                    </th>
                                                    <th>Previous Bill</th>
                                                    <th>Total</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>Receipt</th>
                                                    <th>Mode</th>
                                                    <th>Send Bill</th>
                                                    <!-- <th>Edit Bill</th> -->
                                                    <!-- <th>Delete Bill</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bill as $b)
                                                <tr>
                                                    <td>{{$b->date}}</td>
                                                    <td>{{$b->cname}}</td>
                                                    <td>{{$b->current_unit}}</td>
                                                    <td>{{$b->previous_unit}}</td>
                                                    <td>{{$b->difference}}</td>
                                                    <td>{{$b->month_bill}}</td>
                                                    <td>{{$b->pre_bill}}</td>
                                                    <td>{{$b->total}}</td>
                                                    <td>{{$b->paid}}</td>
                                                    <td>{{$b->balance}}</td>
                                                    <td><a href="{{url('/recipt')}}/{{$b->id}}" class="btn btn-primary">View Recipt</a></td>
                                                    <td>{{$b->mode}}</td>
                                                    <td style="text-align: center;">
                                                        @if($b->bss == 'Success' and date('F', strtotime($b->bsd)) == date('F')) {{$b->bss}} on {{$b->bsd}} <br> <a class="btn btn-info" href="{{url('/resend_masage')}}/{{$b->id}}">Resend <i class="ion ion-md-paper-plane"></i></a> @endif
                                                        @if($b->bss != 'Success')
                                                        <a class="btn btn-dark" href="{{url('/send_bill')}}"><i class="ion ion-md-paper-plane"></i></a>
                                                        @endif
                                                    </td>
                                                        <!-- <td style="text-align: center;font-size:15px;"><a href="{{url('/edit_bill')}}/{{$b->id}}"><i class="ti-check-box"></i></a></td> -->
                                                        <!-- <td style="text-align: center;"><a onclick="return confirm('Are you sure?')" href="{{url('/delete_bill')}}/{{$b->id}}"><i class="ti-trash"></i></a></td> -->
                                                        <td>
                                                            <a class="btn btn-success" href="{{url('/edit_bill')}}/{{$b->id}}"><i class="ti-check-box"></i></a>
                                                            @if(Auth::user()->role == "Admin")
                                                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/delete_bill')}}/{{$b->id}}"><i class="ti-trash"></i></a>
                                                            @endif
                                                        </td>
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