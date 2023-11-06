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
                        
                        <!-- end page title -->
                        
                        
                        <!-- show data -->
                        @include("dash_cut/report_form")
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Date</th> -->
                                                    <th>Customer Name</th>
                                                    <th> Total Water Consumed</th>
                                                    <!-- <th>Bill</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bill as $b)
                                                <tr>
                                                    <td>{{$b->cname}}</td>
                                                    <td>{{$b->current_unit + $b->previous_unit}}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            <!-- <tbody> -->
                                            <!-- </tbody> -->
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
                
    
