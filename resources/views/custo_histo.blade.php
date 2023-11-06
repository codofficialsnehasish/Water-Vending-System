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
                        @include("dash_cut/customer_history_form")
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                        <div class="d-grid">
                                            <a class="btn btn-outline-success">Customer Details</a>
                                        </div>    
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <th>Name</th>
                                                    <th>Telephone</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$custo->c_account_number}}</td>
                                                    <td>{{$custo->cname}}</td>
                                                    <td>{{$custo->cphone}}</td>
                                                    <td>{{$custo->caddress}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                        <div class="d-grid">
                                            <a class="btn btn-outline-success">Customer Bills</a>
                                        </div>    
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bill as $b)
                                                <tr>
                                                    <td>{{$b->date}}</td>
                                                    <td>{{$b->current_unit}}</td>
                                                    <td>{{$b->previous_unit}}</td>
                                                    <td>{{$b->difference}}</td>
                                                    <td>{{$b->month_bill}}</td>
                                                    <td>{{$b->pre_bill}}</td>
                                                    <td>{{$b->total}}</td>
                                                    <td>{{$b->paid}}</td>
                                                    <td>{{$b->balance}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                        <div class="d-grid">
                                            <a class="btn btn-outline-success">Customer Payments</a>
                                        </div>    
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Total Balance</th>
                                                    <th>Paid Amount</th>
                                                    <th>Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pay as $b)
                                                <tr>
                                                    <td>{{$b->date}}</td>
                                                    <td>{{$b->previous_balance}}</td>
                                                    <td>{{$b->paid_amount}}</td>
                                                    <td>{{$b->payment_mode}}</td>
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
                
    
