<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Meter;
use App\Models\Customer;
use App\Models\Status;
use App\Models\Area;
use App\Models\Bill;
use App\Models\ExpenceCatagory;
use App\Models\Expences;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    function __construct() {
        //
    }
    public function dashboard(){
        $users = Customer::where("is_subscribed","!=",0)->count();
        $customer = Customer::where("is_subscribed","=",0)->count();
        $bill = Bill::all()->count();
        $exp = Meter::all()->count();
        return view("dashboard")->with(["users"=>$users,"customer"=>$customer,"bill"=>$bill,"exp"=>$exp]);
    }

    public function register(){
        return view("register");
    }

    public function adduser(Request $r){
        $user = new User();

        $user->role = $r->role;
        $user->name = $r->name;
        $user->email = $r->email;
        $user->phone = $r->phone;
        $user->password = bcrypt($r->pass);
        $user->save();

        return redirect(url('/showuser'));
    }

    public function show_user(){
        $udata = User::all();
        return view("showuser")->with(['data'=>$udata]);
    }

    public function login(){
        return view("login");
    }

    public function checkuser(Request $r){
        echo $r->pass;
        if(Auth::attempt(["email"=>$r->email,"password"=>$r->pass])){
            return redirect(url('/dashboard'));
        }else{
            return redirect(url('/'))->with(["msg"=>"Invalid Login"]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }

    public function customer(){
        return view("addcustomer");
    }

    public function addcustomer(Request $r){
        
        $customer = new Customer();
        $customer->member_name = $r->name;
        $customer->gender = $r->gender;
        $customer->dob = $r->dob;
        $customer->phone = $r->phone;
        $customer->address = $r->addr;
        $customer->gym_group = $r->group;
        // $customer->profile_picture
        $customer->save();
        return redirect(url('/showcustomer'));
    }

    public function showcustomer(){
        $c = Customer::all();
        return view("showcustomer")->with(["customer"=>$c]);
    }

    public function meter(){
        return view("meter");
    }

    public function addmeter(Request $r){
        $m = new Meter();

        $m->package_name = $r->meter;
        $m->price = $r->price;
        $m->duration_value = $r->duration;
        $m->duration = $r->package;
        $m->save();

        return redirect(url('/show_meter'));
    }

    public function customerdel(Request $r){
        $id = $r->id;
        $custo = Customer::find($id);
        
        // if(Bill::where("customer_id","=",$id)->count() > 0){
        //     $bid = Bill::where("customer_id","=",$id)->get();
        //     $bill = Bill::find($bid[0]->id);
        //     $bill->delete();
        // }
        // if(Payment::where("customer_id","=",$id)->count() > 0){
        //     $pid = Payment::where("customer_id","=",$id)->get();
        //     $payment = Payment::find($pid[0]->id);
        //     $payment->delete();
        // }
        
        $custo->delete();

        return redirect(url('/showcustomer'));
    }

    public function status(){
        return view("status");
    }

    public function addstatus(Request $r){
        $s = new Status();

        $s->name = $r->status;
        $s->save();
        return redirect(url('/show_status'));
    }

    public function show_status(){
        $obj = Status::all();
        return view("show_status")->with(["data"=>$obj]);
    }

    public function del_status(Request $r){
        $id = $r->id;
        $obj = Status::find($id);
        $obj->delete();
        return redirect(url('/show_status'));
    }

    public function edit_status(Request $r){
        $id = $r->id;
        $obj = Status::find($id);
        return view("edit_status")->with(["data"=>$obj]);
    }

    public function update_status(Request $r){
        $id = $r->id;
        $obj = Status::find($id);
        $obj->name = $r->status;
        $obj->update();
        return redirect(url('/show_status'));
    }

    public function show_meter(){
        $obj = Meter::all();
        return view("show_meter")->with(["data"=>$obj]);
    }

    public function del_meter(Request $r){
        $id = $r->id;
        $obj = Meter::find($id);
        $obj->delete();
        return redirect(url('/show_meter'));
    }

    public function edit_meter(Request $r){
        $id = $r->id;
        $obj = Meter::find($id);
        return view("edit_meter")->with(["data"=>$obj]);
    }

    public function update_meter(Request $r){
        $id = $r->id;
        $obj = Meter::find($id);
        $obj->name = $r->meter;
        $obj->update();
        return redirect(url('/show_meter'));
    }

    public function del_user(Request $r){
        $id = $r->id;
        $obj = User::find($id);
        $obj->delete();
        return redirect(url('/showuser'));
    }

    public function edit_user(Request $r){
        $id = $r->id;
        $obj = User::find($id);
        return view("edit_user")->with(["data"=>$obj]);
    }

    public function update_user(Request $r){
        $id = $r->id;
        $obj = User::find($id);
        $obj->role = $r->role;
        $obj->name = $r->name;
        $obj->email = $r->email;
        $obj->phone = $r->phone;
        $obj->update();
        return redirect(url('/showuser'));
    }

    public function change_password(){
        return view("change_pass");
    }

    public function change_pass(Request $r){
        $cp = $r->cp;
        $np = $r->np;
        $conpass = $r->conpass;
        // $bpass = bcrypt($cp);
        // echo $bpass;
        // echo "<br>".Auth::user()->password;
        // echo "<br>".bcrypt($np);
        if (Hash::check($cp, Auth::user()->password)) {
            if($np == $conpass){
                $obj = User::find(Auth::user()->id);
                $obj->password = bcrypt($np);
                $obj->update();
                Auth::logout();
                return redirect(url('/'));
            } else{
                return redirect(url('/changepass'))->with(["msg"=>"Not Matched Confirm Password"]);
            }
        } else {
            return redirect(url('/changepass'))->with(["msg"=>"Not Matched Current Password"]);
        }
    }

    public function area(){
        $customer = Customer::where("is_subscribed","!=",0)->get();
        return view("area")->with(["customer"=>$customer]);
    }

    public function add_area(Request $r){
        $s = new Area();

        $s->member_id = $r->member;
        $s->status = $r->status;
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        // echo date('d-m-Y H:i:s');
        $s->date_time = date('d-m-Y H:i:s');
        $s->save();
        return redirect(url('/showarea'));
    }

    public function show_area(){
        $obj = Area::leftJoin("customer","area.member_id","=","customer.member_id")
        ->get(["area.*","customer.member_name as cname"]);
        return view("show_area")->with(["data"=>$obj]);
    }

    public function del_area(Request $r){
        $id = $r->id;
        $obj = Area::find($id);
        $obj->delete();
        return redirect(url('/showarea'));
    }

    public function edit_area(Request $r){
        $id = $r->id;
        $obj = Area::find($id);
        return view("edit_area")->with(["data"=>$obj]);
    }

    public function update_area(Request $r){
        $id = $r->id;
        $obj = Area::find($id);
        $obj->area_name = $r->area;
        $obj->update();
        return redirect(url('/showarea'));
    }

    public function bill(){
        // $customer = Customer::join("billing","customer.cid","=","billing.customer_id")
        // ->whereNull("billing.customer_id")
        // ->get(["customer.*"]);
        
        $customer = Customer::where("is_subscribed","=",0)->get();
        $p = Meter::all();
        return view("make_bill")->with(["customer"=>$customer,"package"=>$p]);
    }

    public function billc(Request $r){
        $id = $r->id;
        $date = date("dmy");
        $customer = Customer::all();
        $customername = Customer::find($id);
        return view("make_bill")->with(["customer"=>$customer,"name"=>$customername,"date"=>$date]);
    }

    private function calculateValue($val) {
        if ($val <= 3) {
            return ($val * 130) + 50;
        } else if ($val === 4) {
            return ($val * 120) + 50;
        } else if ($val <= 6) {
            return ($val * 120) + 50;
        } else if ($val >= 7) {
            return ($val * 110) + 50;
        } else {
            // Handle any other cases here, if necessary
            return 0;
        }
    }

    public function make_bill(Request $r){
        $bill = new Bill();
        $customer = Customer::find($r->member);
        $bill->member_id = $r->member;
        $bill->date = $r->date;
        // echo $r->date."<br>";
        $bill->package_id = $r->pack;
        $customer->is_subscribed = $r->pack;
        $pac = Meter::find($r->pack);
        if($pac->duration == "Year"){
            // $end = date('Y-m-d', strtotime($r->date. ' + '.$pac->duration_value.' years'));
            $bill->end_date = date('Y-m-d', strtotime($r->date. ' + '.$pac->duration_value.' years'));
        }else{
            $bill->end_date = date('Y-m-d', strtotime($r->date. ' + '.$pac->duration_value.' month'));
        }
        $bill->save();
        $customer->update();
        // return redirect(url("/direct_send_masage/{$r->customer}"));
        return redirect(url("/show_bill"));
    }

    public function show_bill(){
        $bill = Bill::leftJoin("customer","billing.member_id","=","customer.member_id")
            ->leftJoin("meter","billing.package_id","=","meter.id")
        ->get(["billing.*","customer.member_name as cname","meter.package_name as mname","meter.duration_value as val","meter.duration as du"]);
        return view("show_bill")->with(["bill"=>$bill]);
    }

    public function delete_bill(Request $r){
        $id = $r->id;
        $obj = Bill::find($id);
        $obj->delete();
        return redirect(url('/show_bill'));
    }

    public function edit_bill(Request $r){
        $id = $r->id;
        $obj = Bill::find($id);
        $customer = Customer::all();
        return view("edit_bill")->with(["bill"=>$obj,"customer"=>$customer]);
    }

    public function edited_bill(Request $r){
        $id = $r->id;
        $obj = Bill::find($id);
        echo $r->customer;
        $obj->customer_id = $r->customer;
        $obj->date = $r->date;
        $obj->current_unit = $r->currb;
        $obj->previous_unit = $r->prevb;
        $diff = abs($r->currb - $r->prevb);
        $obj->difference = $diff;
        $jb = self::calculateValue($diff);
        $obj->month_bill = $jb;
        $obj->pre_bill = $r->preb;
        $total = $jb + $r->preb;
        $obj->total = $total; 
        $obj->balance = abs($total - $r->paid);
        $obj->update();
        return redirect(url('/show_bill'));
    }

    public function edit_customer(Request $r){
        $id = $r->id;
        $obj = Customer::find($id);
        return view("edit_customer")->with(["customer"=>$obj]);
    }

    public function update_customer(Request $r){
        $id = $r->id;
        $obj = Customer::find($id);

        $obj->member_name = $r->name;
        $obj->gender = $r->gender;
        $obj->dob = $r->dob;
        $obj->phone = $r->phone;
        $obj->address = $r->addr;
        $obj->gym_group = $r->group;
        // $customer->profile_picture
        $obj->update();
        return redirect(url('/showcustomer'));
    }

    public function add_expences(){
        $expcata = ExpenceCatagory::all();
        return view("add_expences")->with(["expcata"=>$expcata]);
    }

    public function add_e_catagory(){
        return view("expence_catagory");
    }

    public function addexpence(Request $r){
        $obj = new ExpenceCatagory();
        $obj->catagory = $r->cata;
        $obj->save();
        return redirect(url('/showexpence'));
    }

    public function showexpence(){
        $expcata = ExpenceCatagory::all();
        return view("show_expence_catagory")->with(["expcata"=>$expcata]);
    }

    public function addexp(Request $r){
        $obj = new Expences();
        $obj->date = $r->date;
        $obj->expcata_id = $r->cata;
        $obj->amount = $r->amount;
        $obj->remarks = $r->remarks;
        $obj->save();
        return redirect(url('/showexp'));
    }

    public function showexp(){
        $obj = Expences::leftJoin("expence_catagory","expences.expcata_id","=","expence_catagory.id")
        ->get(["expences.*","expence_catagory.catagory as cata"]);
        return view("show_exp")->with(['exp'=>$obj]);
    }

    public function reports(){
        return view("show_reports");
    }

    public function fromto(Request $r){
        $date1 = $r->date1;
        $old_date_timestamp = strtotime($date1);
        $date1 = date('Y-m-d', $old_date_timestamp);   

        $date2 = $r->date2;
        $old_date_timestam = strtotime($date2);
        $date2 = date('Y-m-d', $old_date_timestam);   
        // echo $date1;
        // echo "<br>";
        // echo $date2;
        $report = $r->reports;
        if($r->reports == 1){
            $data = Expences::leftJoin("expence_catagory","expences.expcata_id","=","expence_catagory.id")
            ->whereBetween('date', [$date1, $date2])
            ->get(["expences.*","expence_catagory.catagory as cata"]);
            return view('reports')->with(['data'=>$data]);
        }
        else if($r->reports == 2){
            $obj = Bill::leftJoin("customer","billing.customer_id","=","customer.cid")
            ->whereBetween('date', [$date1, $date2])
            ->get(["billing.*","customer.cname as cname"]);
            return view('bill_balance_report')->with(['bill'=>$obj]);
        }
        else if($r->reports == 3){
            $data = Payment::leftJoin("customer","payment.customer_id","=","customer.cid")
            ->whereBetween('date', [$date1, $date2])
            ->get(["payment.*","customer.cname as name"]);
            return view('payments_reports')->with(['data'=>$data]);
        }
        else if($r->reports == 4){
            // $data = Customer::all();
            $obj = Bill::leftJoin("customer","billing.customer_id","=","customer.cid")
            ->whereBetween('date', [$date1, $date2])
            ->get(["billing.*","customer.cname as cname"]);
            // print($obj);
            return view('water_consumed')->with(["bill"=>$obj]);
        }
        else if($r->reports == 5){
            // $data = Customer::all();
            $obj = Bill::leftJoin("customer","billing.customer_id","=","customer.cid")
            ->whereBetween('date', [$date1, $date2])
            ->where("billing.paid","<=",0)
            ->get(["billing.*","customer.cname as cname"]);
            // print($obj);
            return view('customar_conso')->with(["bill"=>$obj]);
        }
        
    }

    // public function generate_report(){
    //     // $data = Expences::all();
    //     return view('reports');
    // }

    public function delexpence(Request $r){
        $id = $r->id;
        $obj = Expences::find($id);
        $obj->delete();
        return redirect(url('/showexp'));
    }
    
    public function editexpence(Request $r){
        $id = $r->id;
        $obj = Expences::find($id);
        $expcata = ExpenceCatagory::all();
        return view("edit_expence")->with(['data'=>$obj,"expcata"=>$expcata]);
    }

    public function updateexp(Request $r){
        $id = $r->id;
        $obj = Expences::find($id);
        $obj->date = $r->date;
        $obj->expcata_id = $r->cata;
        $obj->amount = $r->amount;
        $obj->remarks = $r->remarks;
        $obj->update();
        return redirect(url('/showexp'));
    }

    public function delexpencecata(Request $r){
        $id = $r->id;
        $obj = ExpenceCatagory::find($id);
        $obj->delete();
        return redirect(url('/showexpence'));
    }

    public function editexpencecata(Request $r){
        $id = $r->id;
        $obj = ExpenceCatagory::find($id);
        return view("edit_expencecata")->with(['data'=>$obj]);
    }

    public function updateexpcata(Request $r){
        $id = $r->id;
        $obj = ExpenceCatagory::find($id);
        $obj->catagory = $r->cata;
        $obj->update();
        return redirect(url('/showexpence'));
    }

    public function payment($id = null){
        if($id != null){
            $custo2 = Customer::find($id);
            // $custo = Customer::all();
            $custo = Customer::join("billing","customer.cid","=","billing.customer_id")
                // ->join("payment","customer.cid","!=","payment.customer_id")
                // ->where("bill_send_status","!=","Success")
                ->get(["customer.*"]);
            $bill = Bill::where("customer_id","=",$id)->first();
            // $bill = Bill::find($id);
            return view("payment")->with(["custo"=>$custo,"bill"=>$bill,"custo2"=>$custo2]);
        }else{
            // $custo = Customer::all();
            $custo = Customer::join("billing","customer.cid","=","billing.customer_id")
                // ->join("payment","customer.cid","!=","payment.customer_id")
                // ->where("bill_send_status","!=","Success")
                ->get(["customer.*"]);
            return view("payment")->with(["custo"=>$custo]);
        }
    }

    public function make_payment(Request $r){
        $pay = new Payment();
        $id = Bill::where("customer_id","=",$r->custo)->get("id");
        $bill = Bill::find($id[0]->id);
        $custo = Customer::find($r->custo);
        $pay->customer_id = $r->custo;
        $pay->date = $r->date;
        $pay->previous_balance = $r->preb;
        $pay->paid_amount = $r->paid;
        $bill->paid = $r->paid;
        $bill->balance = abs($r->preb - $r->paid);
        $bill->mode = $r->pmode;
        $pay->payment_mode = $r->pmode;
        $custo->payment_status = "Paid";
        $custo->payment_date = $r->date;
        $custo->update();
        $bill->update();
        $pay->save();

        return redirect(url('/show_payments'));
    }

    public function show_payments(){
        $obj=Payment::leftJoin("customer","payment.customer_id","=","customer.cid")
        ->get(["payment.*","customer.cname as name"]);
        return view("show_payments")->with(["data"=>$obj]);
    }

    public function recipt(Request $r){
        $id = $r->id;
        // $obj = Bill::find($id);
        $obj = Bill::leftJoin("customer","billing.customer_id","=","customer.cid")->where("billing.id","=",$id)
        ->first(["billing.*","customer.cname as name"]);
        return view("recipt")->with(["bill"=>$obj]);
    }

    public function put_balance(Request $r){
        $id = $r->id;
        // $obj = Bill::find($id);
        $obj['obj'] = Bill::where("customer_id","=",$id)->get("balance");
        // print($obj);
        // $obj['obj'] = array(["balance"=>0]);
        return response()->json($obj);
    }

    public function put_bilreq(Request $r){
        $id = $r->id;
        // $obj = Bill::find($id);
        
        if((Bill::where("customer_id","=",$id)->count()) > 0){
            $obj['obj'] = Bill::where("customer_id","=",$id)->get("previous_unit");
        }else{
            $obj['obj'] = array(["previous_unit"=>0]);
        }
        // print($obj);$obj['obj'] = 
        return response()->json($obj);
    }

    public function pbal(Request $r){
        $id = $r->id;
        // $obj = Bill::find($id);
        // $obj['obj'] = Bill::where("customer_id","=",$id)->get("pre_bill");
        // print($obj);
        if((Bill::where("customer_id","=",$id)->count()) > 0){
            $obj['obj'] = Bill::where("customer_id","=",$id)->get("pre_bill");
        }else{
            $obj['obj'] = array(["pre_bill"=>0]);;
        }
        return response()->json($obj);
    }

    public function send_bill(){
        $customer = Customer::join("billing","customer.cid","=","billing.customer_id")
        ->where("bill_send_status","!=","Success")
        ->where(DB::raw('MONTH(billing.date)'), '=', now()->month)
        ->get(["customer.*"]);
        return view("send_bill")->with(["customer"=>$customer]);
    }

    public function billreq(Request $r){
        $id = $r->id;
        $currentMonth = date('F');
        $lmonth = Date('F', strtotime($currentMonth . " last month"));
        // $obj = Bill::find($id);
        $b = Customer::find($id);
        $a = Bill::where("customer_id","=",$id)->get();
        $obj['obj'] = "Dear ".$b->cname.", Your water bill for the month of ".$lmonth." is kshs ".$a[0]->month_bill.". Current unit ".$a[0]->current_unit.", Previous unit ".$a[0]->previous_unit.", Previous Balance ".$a[0]->pre_bill.", Paybill ".$a[0]->balance;
        //  paybill  4112893. Account Your Name.
        // print($obj);
        return response()->json($obj);
    }


    public function gto(Request $r){
        $obj['obj'] = array(["pre_bill"=>0]);;
        return response()->json($obj);
    }
}
