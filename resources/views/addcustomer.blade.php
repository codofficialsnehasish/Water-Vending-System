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
                                    <h6 class="page-title">Add Customer</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Customer</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Customer</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/showcustomer')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        
                        <!-- register -->
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Customer Through Excel</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/import')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="name">Select File for Upload</label>
                                                        <input type="file" class="form-control" name="select_file" id="name" placeholder="Enter name" required>
                                                    </div>
                                                    @if(count($errors) > 0)
                                                        <div class="alert alert-danger">
                                                        Upload Validation Error<br><br>
                                                        <ul>
                                                        @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                        </ul>
                                                        </div>
                                                    @endif
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Upload</button>
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
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New Customer</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/addcustomer')}}" method="post">
                                                    @csrf
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="acc">Customer Account Number</label>
                                                        <input type="number" class="form-control" name="acc" id="acc" placeholder="Enter account number" required>
                                                    </div>
                                                    <div class="md-3">
                                                        <label for="area" class="form-label">Area</label>
                                                        <select class="form-select" id="area" name="area" required>
                                                            <option selected disabled value="">Choose Area</option>
                                                            @foreach($area as $a)
                                                            <option value="{{$a->id}}">{{$a->area_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="md-3 mt-3">
                                                        <label for="meter" class="form-label">Meter</label>
                                                        <select class="form-select" id="meter" name="meter" required>
                                                            <option selected disabled value="">Choose Meter</option>
                                                            @foreach($meter as $m)
                                                            <option value="{{$m->id}}">{{$m->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid state.</div>
                                                    </div>
                                                    <div class="md-3 mt-3">
                                                        <label for="statu" class="form-label">Status</label>
                                                        <select class="form-select" id="statu" name="status" required>
                                                            <option selected disabled value="">Choose Status</option>
                                                            @foreach($status as $s)
                                                            <option value="{{$s->id}}">{{$s->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid state.</div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Phone No.</label>
                                                        <div>
                                                            <input type="checkbox" id="check1" name="check1" onclick="copyValue();" /><b style="margin:10px;color:green;">Same as Customer Accouent Number</b>
                                                            <input data-parsley-type="number" type="text" name="phone" id="phone" class="form-control" required placeholder="Enter phone number">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="addr">Address</label>
                                                        <div>
                                                            <textarea required class="form-control" name="addr" rows="5" id="addr"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Customer</button>
                                                            <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
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
                    function copyValue() {
                        if(document.getElementById('check1').checked){
                            let text1 = document.getElementById('acc').value;        
                            document.getElementById('phone').value = text1;
                        }
                        else{
                            document.getElementById('phone').value = "";
                        }     
                    }
                </script>

                @include("dash/footer")