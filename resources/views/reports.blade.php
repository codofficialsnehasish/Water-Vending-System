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

                <div class="page-content" style="height: 700px;">
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
                                                    <th>Date</th>
                                                    <th>Expence Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $d)
                                                <tr>
                                                    <td>{{$d->date}}</td>
                                                    <td>{{$d->cata}}</td>
                                                    <td>{{$d->amount}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <!-- <td></td> -->
                                                    <td style="border-left:none;"><b>Total</b></td>
                                                    <!-- <td colspan="2">Total</td> -->
                                                    
                                                    <td></td>
                                                    <td>
                                                        @php 
                                                        $ans = 0
                                                        @endphp
                                                            @foreach($data as $d)
                                                                @php $ans+=$d->amount @endphp
                                                            @endforeach
                                                        @php
                                                            echo $ans
                                                        @endphp
                                                    </td>
                                                    
                                                </tr>
                                                
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
                
    
