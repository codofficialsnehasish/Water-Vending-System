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
                                    <h6 class="page-title">Edit Note</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/show_credit_note')}}">Credit Note</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Note</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_credit_note')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                            <div class="card-header bg-primary text-light">Add New Note</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/edit_c_note')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$note->id}}">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="input-date1">Date</label>
                                                        <input type="date" value="{{$note->date}}" id="input-date1" name="date" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                                        <span class="text-muted">e.g "dd/mm/yyyy"</span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="elm1">Add Note</label>
                                                        <div>
                                                            <textarea id="elm1" name="note">{{$note->note}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Update Note</button>
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