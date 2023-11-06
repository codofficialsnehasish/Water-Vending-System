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
                                    <h6 class="page-title">Credit Notes</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Notes</li>
                                    </ol>
                                </div>
                                @if(Auth::user()->role == "Admin")
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{url('/add_creditNote')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                          <!-- dataTable no-footer dtr-inline collapsed" -->
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Credit Note</th>
                                                    @if(Auth::user()->role == "Admin")
                                                    <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $d)
                                                <tr data-bs-toggle="modal" class="" data-bs-target="#data{{$d->id}}">
                                                    <td>{{$d->date}}</td>
                                                    <td>{!!substr( $d->note, 0,50 )!!}</td>
                                                    <!-- <td><a href="{{url('/recipt')}}" class="btn btn-success">View Recipt</a></td> -->
                                                    @if(Auth::user()->role == "Admin")
                                                    <td>
                                                        <a class="btn btn-success" href="{{url('/credit_note_edit')}}/{{$d->id}}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure ?')" href="{{url('/del_c_note')}}/{{$d->id}}"><i class="ti-trash"></i></a>
                                                    </td>
                                                    @endif
                                                </tr>
                                                <div class="modal fade" id="data{{$d->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                {{$d->date}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $d->note !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
        
                                                <!-- /.modal -->
                                                
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