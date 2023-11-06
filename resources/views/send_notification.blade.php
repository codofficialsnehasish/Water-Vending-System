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
                                    <h6 class="page-title">Send Reminders</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">WVS</a></li>
                                        <li class="breadcrumb-item"><a href="{{url('/send_noti')}}">Reminders</a></li>
                                        <!-- <li class="breadcrumb-item"><a href="{{url('/showcustomer')}}">Customer</a></li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Send Reminders</li>
                                    </ol>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{url('/show_meter')}}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                            <i class="fas fa-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- register -->
                        @if(Session::has("mssg"))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Success!</strong> {{Session::get("mssg")}}
                        </div>
                        @endif
                        @if(Session::has("mssgg"))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Error!</strong> {{Session::get("mssgg")}}
                        </div>
                        @endif
                        <div class="account-pages pt-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">Notificaltion Massage</div>
                                            <div class="card-body">
                                                <form class="custom-validation" action="{{url('/notisend')}}" method="post">
                                                    @csrf
                                                    <div class="md-3">
                                                        <label for="custo" class="form-label">Customer Name</label>
                                                        <select class="form-select" id="custo" name="customer" onchange="req(this.value)" required>
                                                            <option selected disabled value="">Choose Customer</option>
                                                            @foreach($customer as $c)
                                                            <option value="{{$c->cid}}">{{$c->cname}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid area.</div>
                                                    </div>
                                                    <!-- <div class="mb-3">
                                                        <label class="form-label" for="meter"></label>
                                                        <input type="text" class="form-control" name="meter" id="meter" placeholder="Enter meter" required>
                                                    </div> -->
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="elm1">Reminders</label>
                                                        <div id="area">
                                                            <textarea id="elm" name="massage" style="width: 100%;height: 150px;padding: 12px 20px;box-sizing: border-box;border: 2px solid #ccc;border-radius: 4px;background-color: #f8f8f8;font-size: 16px;">
                                                                This is auto generated text. Please choose the customer name
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function req(id){
                                                            // alert(id)
                                                            // $('#dropdown'+id).html('');
                                                            $.ajax({
                                                                url:'/baliszero/'+id,
                                                                type:'GET',
                                                                data: {},
                                                                success:function(resp){
                                                                    // alert(JSON.stringify(resp))
                                                                    // const data = JSON.parse(resp);
                                                                    console.log(resp.obj);
                                                                    $('#elm').html(resp.obj);
                                                                    // reqb(id);
                                                                }
                                                            })
                                                        }
                                                    </script>
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Send Notification</button>
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