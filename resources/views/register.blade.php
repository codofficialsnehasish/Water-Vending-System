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
                                    <h6 class="page-title">Add User</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/showuser')}}">Users</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/showuser')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Add New User</div>
                                                <div class="card-body">
                                                    <form action="{{url('/adduser')}}" method="post" class="custom-validation">
                                                        @csrf
                                                        <div class="md-3">
                                                            <label for="role" class="form-label">Role</label>
                                                            <select class="form-select" id="role" name="role" required>
                                                                <option selected disabled value="">Choose Role</option>
                                                                <option value="Admin">Admin</option>
                                                                <option value="User">User</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please select a valid state.</div>
                                                        </div>
                                                        <div class="mb-3 mt-3">
                                                            <label class="form-label" for="username">Name</label>
                                                            <input type="text" class="form-control" name="name" id="username" placeholder="Enter name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="useremail">Email</label>
                                                            <input type="email" class="form-control" name="email" id="useremail" placeholder="Enter email" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="phone">Phone No.</label>
                                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter phone" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="userpassword">Password</label>
                                                            <input type="password" name="pass" class="form-control" id="userpassword" placeholder="Enter password" required>
                                                        </div>
                                                        <div class="mb-0">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Add User</button>
                                                                <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="mb-3 row">
                                                            <div class="col-12 text-end">
                                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                                            </div>
                                                        </div> -->
                                                    </form>
                                                </div>
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