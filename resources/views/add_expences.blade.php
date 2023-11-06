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
                                    <h6 class="page-title">Add Expences</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/showexp')}}">Expences</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Expences</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/showexp')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <div class="card-header bg-primary text-light">Add New Expences</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/addexp')}}" method="post">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" id="input-date1" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div>
                                                    <div class="md-3">
                                                        <label for="cata" class="form-label">Expences Catacories</label>
                                                        <select class="form-select" id="cata" name="cata" required>
                                                            <option selected disabled value="">Choose Catagory</option>
                                                            @foreach($expcata as $exp)
                                                            <option value="{{$exp->id}}">{{$exp->catagory}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="amount">Amount</label>
                                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter expence amount" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="elm1">Remarks</label>
                                                        <div>
                                                            <textarea id="elm1" name="remarks"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add Expence</button>
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


                
                @include("dash/footer")