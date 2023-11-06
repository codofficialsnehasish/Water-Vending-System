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
                                    <h6 class="page-title">Edit Bill</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Bills</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Bill</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_bill')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Edit Bill</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/editbill')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$bill->id}}">
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Customer</label>
                                                        <select class="form-select" id="custo" name="customer" required>
                                                            <option selected disabled value="">Choose Customer</option>
                                                            @foreach($customer as $c)
                                                            <option @if($bill->customer_id == $c->cid) selected @endif value="{{$c->cid}}">{{$c->cname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" id="input-date1" value="{{$bill->date}}" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="currb">Current Unit</label>
                                                        <input type="text" onchange="get_total(this.value)" class="form-control" value="{{$bill->current_unit}}" name="currb" id="currb" placeholder="Enter current bill" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="prevb">Previous Unit</label>
                                                        <input type="text" id="punit" class="form-control" value="{{$bill->previous_unit}}" name="prevb" id="prevb" placeholder="Enter previous bill" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="preb">Previous Bill</label>
                                                        <input type="text" id="pbal" class="form-control" value="{{$bill->pre_bill}}" name="preb" id="preb" placeholder="Enter previous bill" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="total">Total Bill</label>
                                                        <input type="text" id="total" value="{{$bill->total}}" class="form-control" name="total" placeholder="Enter previous bill" required>
                                                    </div>
                                                    <!-- <div class="mb-3 mt-3">
                                                        <label class="form-label" for="paid">Paid</label>
                                                        <input type="text" class="form-control" value="{{$bill->paid}}" name="paid" id="paid" placeholder="Enter paid amount" required>
                                                    </div>
                                                    <div class="md-3">
                                                        <label for="pmode" class="form-label">Payment Mode</label>
                                                        <select class="form-select" id="pmode" name="pmode" required>
                                                            <option selected disabled value="">Choose Payment Mode</option>
                                                            <option @if($bill->mode == "Cash") selected @endif value="Cash">Cash</option>
                                                            <option @if($bill->mode == "Paybill") selected @endif value="Paybill">Paybill</option>
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div> -->
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Edit Bill</button>
                                                            <!-- <button type="reset" class="btn btn-secondary waves-effect">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <!-- end register -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function get_total(b){
		                // alert(id)
		                // $('#dropdown'+id).html('');
                        a = $('#punit').val();
                        c = $('#pbal').val();
                        div = Math.abs(b-a);
                        jb = calculateValue(div);
                        // alert(jb);
                        total = parseInt(c)+parseInt(jb);
                        // alert(total);
                        $("#total").val(total);
                    }
                    function calculateValue(val) {
                        if (val <= 3) {
                            return (val * 130) + 50;
                        } else if (val === 4) {
                            return (val * 120) + 50;
                        } else if (val <= 6) {
                            return (val * 120) + 50;
                        } else if (val >= 7) {
                            return (val * 110) + 50;
                        } else {
                            // Handle any other cases here, if necessary
                            return 0;
                        }
                    }
                </script>
                
                @include("dash/footer")