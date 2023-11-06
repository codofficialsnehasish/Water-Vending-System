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
                                    <h6 class="page-title">Add Credit Note</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/show_credit_note')}}">Credit Note</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Note</li>
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

                    
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add Credit Note</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/post_creditNote')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Customer</label>
                                                        <select class="form-select" id="custo" name="customer" onchange="req(this.value)" required>
                                                            <option selected disabled value="">Choose Customer</option>
                                                            @foreach($customer as $c)
                                                            <option @if(isset($name) && $name->cname == $c->cname) selected @endif value="{{$c->cid}}">{{$c->cname}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    
                                                    <script>
                                                        function req(id){
                                                            // alert(id)
                                                            // $('#dropdown'+id).html('');
                                                            $.ajax({
                                                                url:'/cd_note/'+id,
                                                                type:'GET',
                                                                data: {},
                                                                success:function(resp){
                                                                    // alert(JSON.stringify(resp))
                                                                    // const data = JSON.parse(resp);
                                                                    console.log(resp[0]);
                                                                    $('#dates').val(resp[0].date);
                                                                    $('#rnum').val(resp[0].receipt_number);
                                                                    $('#cunit').val(resp[0].current_unit);
                                                                    $('#punit').val(resp[0].previous_unit);
                                                                    $('#pbill').val(resp[0].month_bill);
                                                                    $('#pbal').val(resp[0].pre_bill);
                                                                    $('#total').val(resp[0].total);
                                                                    $('#pamount').val(resp[0].paid);
                                                                    $('#balrem').val(resp[0].balance);
                                                                    $('#bill_id').val(resp[0].id);
                                                                    // reqb(id);
                                                                }
                                                            })
                                                        }
                                                    </script>
                                                    <input type="hidden" name="bill_id" id="bill_id">
                                                    <div data-repeater-list="outer-group" class="outer">
                                                        <div data-repeater-item class="outer">
                                                            <div class="mb-3 mt-3">
                                                                <label class="form-label" for="rnum">Receipt Number:</label>
                                                                <input type="number" id="rnum" name="reciptnum" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3 mt-3">
                                                                <label class="form-label" for="date">Date:</label>
                                                                <input type="date" id="dates" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cunit">Current Unit:</label>
                                                                <input type="text" name="curru" class="form-control" id="cunit">
                                                            </div>
                
                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Previous Unit :</label>
                                                                <input type="text" name="prevu" class="form-control" id="punit">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Previous Bill :</label>
                                                                <input type="text" name="pbill" class="form-control" id="pbill">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Previous Balance :</label>
                                                                <input type="text" name="pbal" class="form-control" id="pbal">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Total :</label>
                                                                <input type="text" name="total" class="form-control" id="total">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Paid Amount :</label>
                                                                <input type="text" name="pamount" class="form-control" id="pamount">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="punit">Balance Remaining:</label>
                                                                <input type="text" name="balrem" class="form-control" id="balrem">
                                                            </div>
                
                                                            <!-- <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner-group" class="inner mb-3">
                                                                    <label class="form-label">Phone no :</label>
                                                                    <div data-repeater-item class="inner mb-3 row">
                                                                        <div class="col-md-10 col-sm-8">
                                                                            <input type="text" class="inner form-control" placeholder="Enter your phone no..."/>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-4">
                                                                            <div class="d-grid">
                                                                                <input data-repeater-delete type="button" class="btn btn-primary inner mt-2 mt-sm-0" value="Delete"/>
                                                                            </div>    
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <input data-repeater-create type="button" class="btn btn-success inner" value="Add Number"/>
                                                            </div> -->
                
                                                            <div class="mb-3">
                                                                <label class="form-label" for="formmessage">Narration  :</label>
                                                                <textarea id="formmessage" name="msg" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                @include("dash/footer")