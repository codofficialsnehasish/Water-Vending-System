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
use App\Models\Creditnotes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    function __construct() {
        if(date('d') == "01"){
            $b = Customer::all();
            $bill = Bill::all();
            foreach($b as $b){
                if($b->bill_send_status == "Success"){
                    $obj = Customer::find($b->cid);
                    $obj->bill_send_status = "Not Send";
                    $obj->bill_send_date = ""; 
                    $obj->messageid = "";
                    $obj->update();
                }
            }
            foreach($bill as $bl){
                $obj = Bill::find($bl->id);
                $obj->month_bill = $bl->balance;
                $obj->update();
            }
        }

        date_default_timezone_set('Africa/Nairobi');
        $date = date('m-d-Y h:i a', time());
        if($date == '10-27-2023 10:00 am'){
            echo "mached";
        }
    }
    public function dashboard(){
        $users = User::all()->count();
        $customer = Customer::all()->count();
        $bill = Bill::all()->count();
        $exp = Expences::all()->count();
        $send_bill = Customer::where("bill_send_status","=","Success")->count();
        return view("dashboard")->with(["users"=>$users,"customer"=>$customer,"bill"=>$bill,"exp"=>$exp,"bs"=>$send_bill]);
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
        $obj = Meter::all();
        $obj2 = Status::all();
        $obj3 = Area::all();
        return view("addcustomer")->with(["meter"=>$obj, "status"=>$obj2, "area"=>$obj3]);
    }

    public function addcustomer(Request $r){
        // $c = Customer::all()->count();
        // if($c > 0){
        //     $id = Customer::all()->last();
        //     $date = (string)date("dmy");
        //     $acc = $date.strval($id->cid + 1);
        // }else{
        //     $date = (string)date("dmy");
        //     $acc = $date.strval(1);
        // }
        $customer = new Customer();
        $customer->c_account_number = "254".$r->acc;
        $customer->cname = $r->name;
        $customer->carea = $r->area;
        $customer->meter_id = $r->meter;
        $customer->status = $r->status;
        $customer->cphone = $r->phone;
        $customer->caddress = $r->addr;
        $customer->save();
        return redirect(url('/showcustomer'));
    }

    public function showcustomer(){
        $c = Customer::leftJoin("meter","customer.meter_id","=","meter.id","and","customer.status","=","status.id")
        ->leftJoin("status","customer.status", "=", "status.id")
        ->leftJoin("area","customer.carea", "=", "area.id")
        // ->rightJoin("billing","customer.cid", "=", "billing.customer_id")
        ->get(["customer.*","meter.name as name","status.name as status", "area.area_name as area"]);
        // ->get(["customer.*","meter.name as name","status.name as status", "area.area_name as area","billing.*"]);
        $obj = DB::table('billing')->where(DB::raw('MONTH(billing.date)'), '=', now()->month)->get();
        
        return view("showcustomer")->with(["customer"=>$c,"bill"=>$obj]);
    }

    public function meter(){
        return view("meter");
    }

    public function addmeter(Request $r){
        $m = new Meter();

        $m->name = $r->meter;
        $m->save();

        return redirect(url('/show_meter'));
    }

    public function customerdel(Request $r){
        $id = $r->id;
        $custo = Customer::find($id);
        
        if(Bill::where("customer_id","=",$id)->count() > 0){
            $bid = Bill::where("customer_id","=",$id)->get();
            $bill = Bill::find($bid[0]->id);
            $bill->delete();
        }
        if(Payment::where("customer_id","=",$id)->count() > 0){
            $pid = Payment::where("customer_id","=",$id)->get();
            $payment = Payment::find($pid[0]->id);
            $payment->delete();
        }
        
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
        return view("area");
    }

    public function add_area(Request $r){
        $s = new Area();

        $s->area_name = $r->area;
        $s->save();
        return redirect(url('/showarea'));
    }

    public function show_area(){
        $obj = Area::all();
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

        $customersNotPaid = DB::table('customer')
            ->leftJoin('billing', function ($join) {
                $join->on('customer.cid', '=', 'billing.customer_id')
                    ->where(DB::raw('MONTH(billing.date)'), '=', now()->month);
            })
            ->whereNull('billing.customer_id')
            ->select('customer.*')
            ->get();
        return view("make_bill")->with(["customer"=>$customersNotPaid]);
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
        
        $c = Bill::all()->count();
        if($c > 0){
            $id = Bill::all()->last();
            $date = (string)date("dmy");
            $recipt = $date.strval($id->id + 1);
        }else{
            $date = (string)date("dmy");
            $recipt = $date.strval(1);
        }
        $obj = Bill::where("customer_id","=",$r->customer)->get("id");
        // echo $r->customer;
        
        if($obj != "[]"){
            $obj = Bill::find($obj[0]->id);
            // echo $obj;
            // $obj->delete();
        }

        if($r->submit == "makebill"){
            $bill = new Bill();
            $bill->receipt_number = $recipt;
            $bill->customer_id = $r->customer;
            $bill->date = $r->date;
            $bill->current_unit = $r->curru;
            $bill->previous_unit = $r->prevu;
            $diff = abs($r->curru - $r->prevu);
            $bill->difference = $diff;
            $jb = self::calculateValue($diff);
            $bill->month_bill = $jb;
            $bill->pre_bill = $r->preb;
            $total = $jb + $r->preb;
            $bill->total = $total;
            // $bill->paid = $r->paid;
            $bill->balance = abs($total - $r->paid);
            // $bill->mode = $r->pmode;
            $bill->save();
            return redirect(url("/show_bill"));
        }
        elseif($r->submit == "sendbill"){
            $bill = new Bill();
            $bill->receipt_number = $recipt;
            $bill->customer_id = $r->customer;
            $bill->date = $r->date;
            $bill->current_unit = $r->curru;
            $bill->previous_unit = $r->prevu;
            $diff = abs($r->curru - $r->prevu);
            $bill->difference = $diff;
            $jb = self::calculateValue($diff);
            $bill->month_bill = $jb;
            $bill->pre_bill = $r->preb;
            $total = $jb + $r->preb;
            $bill->total = $total;
            // $bill->paid = $r->paid;
            $bill->balance = abs($total - $r->paid);
            // $bill->mode = $r->pmode;
            $bill->save();
            return redirect(url("/direct_send_masage/{$r->customer}"));
        }
        // return redirect(url("/show_bill"));
    }

    public function show_bill(){
        $bill = Bill::leftJoin("customer","billing.customer_id","=","customer.cid")
        ->where(DB::raw('MONTH(billing.date)'), '=', now()->month)
        ->get(["billing.*","customer.cname as cname","customer.cid as cid","customer.bill_send_status as bss","customer.bill_send_date as bsd"]);
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
        $obj2 = Meter::all();
        $obj3 = Status::all();
        $obj4 = Area::all();
        return view("edit_customer")->with(["customer"=>$obj,"meter"=>$obj2, "status"=>$obj3, "area"=>$obj4]);
    }

    public function update_customer(Request $r){
        $id = $r->id;
        $obj = Customer::find($id);

        $obj->c_account_number = $r->acc;
        $obj->cname = $r->name;
        $obj->carea = $r->area;
        $obj->meter_id = $r->meter;
        $obj->status = $r->status;
        $obj->cphone = $r->phone;
        $obj->caddress = $r->addr;
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
                ->distinct()
                ->get(["customer.*"]);
            $bill = Bill::where("customer_id","=",$id)->first();
            // $bill = Bill::find($id);
            return view("payment")->with(["custo"=>$custo,"bill"=>$bill,"custo2"=>$custo2]);
        }else{
            // $custo = Customer::all();
            $custo = Customer::join("billing","customer.cid","=","billing.customer_id")
                // ->join("payment","customer.cid","!=","payment.customer_id")
                // ->where("bill_send_status","!=","Success")
                ->distinct()
                ->get(["customer.*"]);
            return view("payment")->with(["custo"=>$custo]);
        }
    }

    public function make_payment(Request $r){
        $custo = Customer::find($r->custo);
        if($r->pmode == 'Cash'){
            $pay = new Payment();
            $id = Bill::where("customer_id","=",$r->custo)->get("id");
            $bill = Bill::find($id[0]->id);
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
        }else if($r->pmode == 'Paybill'){
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . base64_encode('jApa4OY7DGt8lrpiYvRWJSnRYaxfHD0y:XeG5HoUpQzOZ7Wbo')
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response,true);
            // echo  $data['access_token'];
            
            
            $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer '.$data['access_token'],
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            $data = json_encode(array(
                "Initiator"=> 'Esli Enterprises',
                "SecurityCredential"=> base64_encode('12n28A"5'),
                "CommandID"=> "BusinessPayBill",
                "SenderIdentifierType"=> "4",
                "RecieverIdentifierType"=> 4,
                "Amount"=> $r->paid,
                "PartyA"=> 600996,
                "PartyB"=> 636256,
                "AccountReference"=> "353353",
                "Requester"=> "254700000000",
                "Remarks"=> "ok",
                "QueueTimeOutURL"=> "https://mydomain.com/b2b/queue/",
                "ResultURL"=> "https://mydomain.com/b2b/result/",
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }

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
            $obj['obj'] = Bill::where("customer_id","=",$id)->get("current_unit");
        }else{
            $obj['obj'] = array(["current_unit"=>0]);
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
            $obj['obj'] = Bill::where("customer_id","=",$id)->get("balance");
        }else{
            $obj['obj'] = array(["balance"=>0]);;
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
        $custo_name = explode(' ',$b->cname);
        // $obj['obj'] = "Dear ".$custo_name[0].",Your water bill for ".substr($lmonth,0,3)." is Kshs ".$a[0]->month_bill.".Curr unit ".$a[0]->current_unit.",Prev unit ".$a[0]->previous_unit.",Prev bal ".$a[0]->pre_bill.".Our paybill 4112893,account your name";
        $obj['obj'] = "Dear ".$custo_name[0].",Your water bill for ".substr($lmonth,0,3)." is Kshs ".$a[0]->month_bill.",Prev balance ".$a[0]->pre_bill.",Total bill ".$a[0]->total.".Our paybill 4112893,account your name";

        //  ",Paybill ".$a[0]->balance.
        // print($obj);
        return response()->json($obj);
    }


    public function gto(Request $r){
        $obj['obj'] = array(["pre_bill"=>0]);;
        return response()->json($obj);
    }


    //for sending notification 
    public function send_notification(){
        date_default_timezone_set('Africa/Nairobi');
        // if(){

        // }
        $customer = Customer::join("billing","customer.cid","=","billing.customer_id")
        // ->where("balance","!=",0)
        // ->where(DB::raw('MONTH(billing.date)'), '=', now()->month)
        ->distinct()
        ->get(["customer.*"]);
        return view("send_notification")->with(["customer"=>$customer]);
    }

    public function baliszero(Request $r){
        $id = $r->id;
        $currentMonth = date('F');
        $lmonth = Date('F', strtotime($currentMonth . " last month"));
        // $obj = Bill::find($id);
        $b = Customer::find($id);
        $a = Bill::where("customer_id","=",$id)->get();
        $custo_name = explode(' ',$b->cname);
        $obj['obj'] = "Dear ".$custo_name[0].", you are kindly reminded to clear your water bill of Kshs ".$a[0]->balance." which is already over due.";

        //  paybill  4112893. Account Your Name.
        // print($obj);
        return response()->json($obj);
    }

    public function credit_note(){
        // $obj = Customer::all();
        $obj = DB::table('customer')
        ->leftJoin('billing', 'customer.cid', '=', 'billing.customer_id')
        ->where(DB::raw('MONTH(billing.date)'), '=', now()->month)
        ->get();
        // $obj2 = Bill::all();'bill'=>$obj2,
        return view("add_credit_note")->with(['customer'=>$obj]);
    }

    public function credit_note_ajax(Request $r){
        // $obj = Bill::find($r->id);
        $obj = DB::table('billing')->where("customer_id","=",$r->id)
        ->where(DB::raw('MONTH(billing.date)'), '=', now()->month)
        ->get();
        return response()->json($obj);
    }

    public function add_c_note(Request $r){
        // $obj = new Creditnotes();
        // $obj->receipt_number = $r->reciptnum;
        // $obj->customer_id = $r->customer;
        // $obj->date = $r->date;
        // $obj->current_unit = $r->curru;
        // $obj->previous_unit = $r->prevu;
        // $diff = abs($r->curru - $r->prevu);
        // $obj->difference = $diff;
        // $jb = self::calculateValue($diff);
        // $obj->month_bill = $r->pbill;
        // $obj->pre_bill = $r->pbal;
        // $total = $jb + $r->preb;
        // $obj->total = $r->total;
        // $obj->paid = $r->pamount;
        // $obj->balance = $r->balrem;
        // $obj->note = $r->msg;
        // $obj->save();
        // return redirect(url('/show_credit_note'));


        $id = $r->bill_id;
        $obj = Bill::find($id);
        $obj->receipt_number = $r->reciptnum;
        $obj->customer_id = $r->customer;
        $obj->date = $r->date;
        $obj->current_unit = $r->curru;
        $obj->previous_unit = $r->prevu;
        $diff = abs($r->currb - $r->prevb);
        $obj->difference = $diff;
        $jb = self::calculateValue($diff);
        $obj->month_bill = $r->pbill;
        $obj->pre_bill = $r->pbal;
        $total = $jb + $r->preb;
        $obj->total = $r->total; 
        $obj->balance = $r->balrem;
        $obj->bill_type = "CREDIT NOTE";
        $obj->credit_note = $r->msg;
        $obj->update();
        return redirect(url('/show_bill'));
    }

    public function show_credit_note(){
        $obj = Creditnotes::all();
        return view("show_credit_note")->with(["data"=>$obj]);
    }

    public function del_c_note(Request $r){
        $obj = Creditnotes::find($r->id);
        $obj->delete();
        return redirect(url('/show_credit_note'));
    }

    public function credit_note_edit(Request $r){
        $obj = Creditnotes::find($r->id);
        return view("edit_credit_note")->with(['note'=>$obj]);
    }

    public function edit_c_note(Request $r){
        $obj = Creditnotes::find($r->id);
        $obj->date = $r->date;
        $obj->note = $r->note;
        $obj->update();
        return redirect(url('/show_credit_note'));
    }

    public function customer_history(){
        $obj = Customer::all();
        return view("customer_history")->with(["customer"=>$obj]);
    }

    public function fromcus(Request $r){
        $date1 = $r->date1;
        $old_date_timestamp = strtotime($date1);
        $date1 = date('Y-m-d', $old_date_timestamp);   

        $date2 = $r->date2;
        $old_date_timestam = strtotime($date2);
        $date2 = date('Y-m-d', $old_date_timestam);   
        // echo $date1;
        // echo "<br>";
        // echo $date2;
        // $customer = $r->customer;
        // echo $r->customer;
        $obj = Customer::all();
        $obj2 = Customer::find($r->customer);
        $obj3 = Bill::where("customer_id","=",$r->customer)->get();
        // print_r($obj3);
        $obj4 = Payment::where("customer_id","=",$r->customer)->get();
        return view('custo_histo')->with(["customer"=>$obj,"custo"=>$obj2,"bill"=>$obj3,"pay"=>$obj4]);
    }
}