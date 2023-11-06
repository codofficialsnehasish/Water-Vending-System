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
                                                    <th>Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Previous Balance</th>
                                                    <th>Paid Amount</th>
                                                    <th>Mode</th>
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
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <!-- <td></td> -->
                                                    <td><b>Total</b></td>
                                                    <!-- <td colspan="2">Total</td> -->
                                                    
                                                    <td></td>
                                                    <td>
                                                        @php 
                                                        $ans = 0
                                                        @endphp
                                                            @foreach($data as $d)
                                                                @php $ans+=$d->previous_balance @endphp
                                                            @endforeach
                                                        @php
                                                            echo $ans
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php 
                                                        $ans = 0
                                                        @endphp
                                                        @foreach($data as $d)
                                                        @php $ans+=$d->paid_amount @endphp
                                                        @endforeach
                                                        @php
                                                        echo $ans
                                                        @endphp
                                                    </td>
                                                    <td></td>
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
                
    
