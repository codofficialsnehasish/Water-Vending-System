<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;

class MassageAPI extends Controller
{
    public function bill_send(Request $r){
        $id = $r->customer;
        $obj = Customer::find($id);
        $cphone = "254".$obj->cphone;
        // echo $response;
        $res = json_decode(self::send_API($r->massage, $cphone));
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $obj->bill_send_status = $res->responses[0]->{'response-description'};
            $obj->bill_send_date = date('d-m-y');
            $obj->messageid = $res->responses[0]->messageid;
            $obj->update();
            $msg = "The Bill has been send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_bill'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Bill has not send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_bill'))->with(["mssgg"=>$msg]);
        }
        // print_r( $res->responses[0]->{'response-description'});
    }
    public function noti_send(Request $r){
        $id = $r->customer;
        $obj = Customer::find($id);
        $cphone = "254".$obj->cphone;
        // echo $response;
        $res = json_decode(self::send_API($r->massage, $cphone));
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $obj->bill_send_status = $res->responses[0]->{'response-description'};
            $obj->bill_send_date = date('d-m-y');
            $obj->messageid = $res->responses[0]->messageid;
            $obj->update();
            $msg = "The Reminders has been send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_noti'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Reminders has not send to the customer's mobile number : ".$obj->cphone;
            return redirect(url('/send_noti'))->with(["mssgg"=>$msg]);
        }
        // print_r( $res->responses[0]->{'response-description'});
    }

    public function notification_conn(Request $r){
        if(date('d') == 15){
            $obj = Customer::leftJoin("billing","customer.cid","=","billing.customer_id")
            ->where("billing.paid","=","Not Paid")
            ->get();
            foreach($obj as $o){
                // print_r($o->cname);
                // $id = $o->cid;
                $cphone = "254".$o->cphone;
                // echo $response;
                $custo_name = explode(' ',$o->cname);
                $massage = "Dear ".$custo_name[0].", you are kindly reminded to clear your water bill of Kshs ".$o->balance." which is already over due.";
                $res = json_decode(self::send_API($massage, $cphone));
            }
        }
    }

    // public function notification_conn(Request $r){
    //     $customer = new Customer();
    //     $customer->c_account_number = "254";
    //     $customer->cname = 'massage';
    //     $customer->carea = 1;
    //     $customer->meter_id = 2;
    //     $customer->status = 3;
    //     $customer->cphone = 203265987;
    //     $customer->caddress = 'ja iccha';
    //     $customer->save();
    // }

    public function resend_masage(Request $r){
        $id = $r->id;
        $a = Bill::find($id);
        // $custo = Customer::find($a->customer_id);

        $currentMonth = date('F');
        $lmonth = Date('F', strtotime($currentMonth . " last month"));
        // $obj = Bill::find($id);
        $b = Customer::find($a->customer_id);
        $cphone = "254".$b->cphone;
        // $a = Bill::where("customer_id","=",$id)->get();
        $custo_name = explode(' ',$b->cname);
        $msg = "Dear ".$custo_name[0].",Your water bill for ".substr($lmonth,0,3)." is Kshs ".$a->month_bill.".Prev balance ".$a->pre_bill.",Total bill ".$a->total.".Our paybill 4112893,account your name";
        //",Paybill ".$a->balance.

        $res = json_decode(self::send_API($msg, $cphone));
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $b->bill_send_status = $res->responses[0]->{'response-description'};
            $b->bill_send_date = date('d-m-y');
            $b->messageid = $res->responses[0]->messageid;
            $b->update();
            $msg = "The Bill has been resend to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Bill has not resend to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssgg"=>$msg]);
        }
    }

    public function direct_send_masage(Request $r){
        $id = $r->id;
        $b = Customer::find($id);
        $a = Bill::where("customer_id","=",$id)->get();

        $currentMonth = date('F');
        $lmonth = Date('F', strtotime($currentMonth . " last month"));
        $cphone = "254".$b->cphone;
        // Dear (customer's name) Your water bill for the month of August is kshs 2000, curr unit 20, prev unit 10, prev bal 100. our paybill is 4112893, account your Name
        // $a = Bill::where("customer_id","=",$id)->get();
        $custo_name = explode(' ',$b->cname);
        $msgs = "Dear ".$custo_name[0].",Your water bill for ".substr($lmonth,0,3)." is Kshs ".$a[0]->month_bill.",Prev balance ".$a[0]->pre_bill.",Total bill ".$a[0]->total.".Our paybill 4112893,account your name";
        //.",Paybill ".$a[0]->balance.
 
        $res = json_decode(self::send_API($msgs, $cphone));
        // print_r($res);
        if(($res->responses[0]->{'response-description'}) == "Success"){
            $b->bill_send_status = $res->responses[0]->{'response-description'};
            $b->bill_send_date = date('d-m-y');
            $b->messageid = $res->responses[0]->messageid;
            $b->update();
            $msg = "The Bill has been send to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssg"=>$msg]);
        }else{
            $msg = "The Bill has not send to the customer's mobile number : ".$b->cphone;
            return redirect(url('/show_bill'))->with(["mssgg"=>$msg]);
        }
    }



    public function send_API($massage, $phone){
        $partnerID = "8624";
        // $apikey = "0ddc86f287ed8ab3fb890649b43a46a8";
        $apikey = "292fa6fae2d40d243c86c468ac026b9e";
        // $shortcode = "QUEEN-PEACE";
        $shortcode = "ESLI";

        $mobile = $phone; // Bulk messages can be comma separated
        // $mobile = "7031182870";
        // $mobile = "254703118287"; // Bulk messages can be comma separated
        $message = $massage;
        // $message = "hello world";

        // $finalURL = "https://www.textsms.co.ke/api/services/sendsms/?apikey=" . urlencode($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$mobile";
        $finalURL = "https://sms.textsms.co.ke/api/services/sendsms/?apikey=" . urlencode($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$mobile";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $finalURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
