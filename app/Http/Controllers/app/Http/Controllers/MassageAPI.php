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
        $msg = "Dear ".$b->cname.", Your water bill for the month of ".$lmonth." is Kshs ".$a->month_bill.". Current unit ".$a->current_unit.", Previous unit ".$a->previous_unit.", Previous Balance ".$a->pre_bill.", Paybill ".$a->balance;
        // "Dear ".$b->cname.", Your water bill for the month of ".$lmonth." is kshs ".$a[0]->month_bill.". Current unit ".$a[0]->current_unit.", Previous unit ".$a[0]->previous_unit.", Previous Balance ".$a[0]->pre_bill.", Paybill ".$a[0]->balance;

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
        $msgs = "Dear ".$b->cname.", Your water bill for the month of ".$lmonth." is kshs ".$a[0]->month_bill.". Current unit ".$a[0]->current_unit.", Previous unit ".$a[0]->previous_unit.", Previous Balance ".$a[0]->pre_bill.", Paybill ".$a[0]->balance;
 
        $res = json_decode(self::send_API($msgs, $cphone));
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



    public function send_API($massage, $phone){
        $partnerID = "8624";
        // $apikey = "0ddc86f287ed8ab3fb890649b43a46a8";
        $apikey = "292fa6fae2d40d243c86c468ac026b9e";
        // $shortcode = "QUEEN-PEACE";
        // $shortcode = "PV_Tech";
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
