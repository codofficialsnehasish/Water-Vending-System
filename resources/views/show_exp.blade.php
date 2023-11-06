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
                                    <h6 class="page-title">Expences</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Expences</li>
                                    </ol>
                                </div>
                                @if(Auth::user()->role == "Admin")
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_expences')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                                    <th>Expence Name</th>
                                                    <th>Amount</th>
                                                    <th>Remarks</th>
                                                    @if(Auth::user()->role == "Admin")
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    @endif
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($exp as $d)
                                                <tr>
                                                    <td>{{$d->date}}</td>
                                                    <td>{{$d->cata}}</td>
                                                    <td>{{$d->amount}}</td>
                                                    <td>{!! $d->remarks !!}</td>
                                                    @if(Auth::user()->role == "Admin")
                                                    <td style="text-align: center;font-size:15px;"><a class="btn btn-success" href="{{url('/editexpence')}}/{{$d->id}}"><i class="ti-check-box"></i></a></td>
                                                    <td style="text-align: center;font-size:15px;"><a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('/delexpence')}}/{{$d->id}}"><i class="ti-trash"></i></a></td>
                                                    @endif
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
