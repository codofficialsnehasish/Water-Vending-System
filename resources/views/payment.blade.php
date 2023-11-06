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
                                    <h6 class="page-title">Payment</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Bills</a></li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_payments')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <div class="card-header bg-primary text-light">Payment</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/make_payment')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Customer Name</label>
                                                        <!-- <input type="text" class="form-control" name="custo" id="custo" placeholder="Customer name" required> -->
                                                        <select class="form-select" id="custo" name="custo" onchange="req(this.value)" required>
                                                            <option selected disabled value="">Customer name</option>
                                                            @foreach($custo as $c)
                                                            <option @if(isset($custo2) && $custo2->cid == $c->cid) selected @endif value="{{$c->cid}}" >{{$c->cname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" id="input-date1" value="20@php echo date('y-m-d') @endphp" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div>
                                                    
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="preb">Total Balance</label>
                                                        <input type="text" id="bal" value="@if(isset($bill)){{$bill->balance}}@endif" class="form-control" name="preb" id="preb" placeholder="Enter balance" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="paid">Paid Amount</label>
                                                        <input type="text" class="form-control" name="paid" id="paid" placeholder="Enter paid amount" required>
                                                    </div>
                                                    <div class="md-3">
                                                        <label for="pmode" class="form-label">Payment Mode</label>
                                                        <select class="form-select" id="pmode" name="pmode" required>
                                                            <option selected disabled value="">Choose Payment Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Paybill">Paybill</option>
                                                            <!-- <option value="Cash">Cash</option> -->
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-0 mt-3">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Make Payment</button>
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
                    function req(id){
		                // alert(id)
		                // $('#dropdown'+id).html('');
                        $.ajax({
		                	url:'/req/'+id,
		                	type:'GET',
		                	data: {},
		                	success:function(resp){
		                		// alert(JSON.stringify(resp))
                                // const data = JSON.parse(resp);
                                console.log(resp.obj[0].balance);
                                $('#bal').val(resp.obj[0].balance);
                                // alert(resp.obj[i][0])
                                // $.each(resp.obj, function (i) {
		                		// 	// alert(resp.obj[i][0].)
		                		// 	$.each(resp.obj[i], function (j,k) {
                                //     	$('#bal').text(k);
		                		// 		//alert(k.balance);
                                // 	});
		                		// });
		                	}
		                })
                    }
                </script>
                
                @include("dash/footer")
