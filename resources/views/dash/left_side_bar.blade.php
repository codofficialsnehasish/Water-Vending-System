<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- <li class="menu-title">Main</li> -->
                <li>
                    <a href="{{url('/dashboard')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <!-- <span class="badge rounded-pill bg-primary float-end">2</span> -->
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{url('/register')}}" class=" waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Add User</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/showuser')}}" class=" waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Show User</span>
                    </a>
                </li> -->

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(Auth::user()->role == "Admin")
                        <li><a href="{{url('/register')}}">Add User</a></li>
                        @endif
                        <li><a href="{{url('/showuser')}}">Show User</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/customer')}}">Add New Customer</a></li>
                        <li><a href="{{url('/showarea')}}">Area Master</a></li>
                        <li><a href="{{url('/show_meter')}}">Meter Master</a></li>
                        <li><a href="{{url('/show_status')}}">Status Master</a></li>
                        <li><a href="{{url('/showcustomer')}}">All Customers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout"></i>
                        <span>Bills</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/bill')}}">Make Bill</a></li>
                        <li><a href="{{url('/show_bill')}}">All Bills</a></li>
                        <li><a href="{{url('/send_bill')}}">Send Bill</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-money"></i>
                        <span>Payments</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/payment')}}">Make Payments</a></li>
                        <li><a href="{{url('/show_payments')}}">All Payments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-microsoft-onenote"></i>
                        <span>Credit Note</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/add_creditNote')}}">Add Note</a></li>
                        <!-- <li><a href="{{url('/show_credit_note')}}">All Notes</a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="{{url('/send_noti')}}" class="waves-effect">
                        <i class="mdi mdi-bell-alert-outline"></i>
                        <!-- <span class="badge rounded-pill bg-danger float-end">2</span> -->
                        <span>Reminders</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-pie-chart"></i>
                        <span>Expenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(Auth::user()->role == "Admin")
                        <li><a href="{{url('/add_expences')}}">Add Expenses</a></li>
                        <!-- <li><a href="{{url('/meter')}}">Add Meter</a></li>
                        <li><a href="{{url('/status')}}">Add Status</a></li> -->
                        @endif
                        <!-- <li><a href="{{url('/showarea')}}">Area Master</a></li>
                        <li><a href="{{url('/show_meter')}}">Meter Master</a></li>
                        <li><a href="{{url('/show_status')}}">Status Master</a></li> -->
                        <li><a href="{{url('/add_e_catagory')}}">Expence Catagory</a></li>
                        <li><a href="{{url('/showexpence')}}">Show Exp Cata</a></li>
                        <li><a href="{{url('/showexp')}}">Show Expences</a></li>
                        <!-- <li><a href="{{url('/reports')}}">Reports</a></li> -->
                        <!-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ti-blackboard"></i>
                                <span>Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{url('/')}}">Expense Report</a></li>
                                <li><a href="{{url('/')}}">Bill Balances Report</a></li>
                                <li><a href="{{url('/')}}">Payments Report</a></li>
                                <li><a href="{{url('/')}}">Water consumed report</a></li>
                                <li><a href="{{url('/')}}">Customer Consolidated</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="{{url('/reports')}}" class="waves-effect">
                        <i class="ti-blackboard"></i>
                        <!-- <span class="badge rounded-pill bg-danger float-end">2</span> -->
                        <span>Reports</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-microsoft-onenote"></i>
                        <span>History</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/customer_history')}}">Customer History</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>