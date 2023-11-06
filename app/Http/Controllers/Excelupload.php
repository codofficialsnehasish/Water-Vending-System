<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\Customer;
use Excel;
use DB;

class Excelupload extends Controller
{
    function import(Request $request){
        $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = ($request->file('select_file')->getPathName());
        // $path = 'C:\xampp\tmp\php1EA3.tmp';
        // print_r( $_FILES);
        // die;.
        // $data = Excel::load($path)->get();
        // $data = Excel::toArray($path,'r');
        // $items = (new ItemsImport)->toCollection($request->file('file'))[0];
        $data = Excel::toArray([], $request->file('select_file'));
        // print_r($rows);
        // die;

        if(count($data) > 0){
                // die;
            foreach($data as $value){
                foreach($value as $row){
                    if(Customer::where("cphone",'=',$row[5])->count() > 0){
                        return redirect()->back()->with('error', 'Duplicate phone number, please check excel.');
                    }
                    if($row[0] == 'Account Number'){continue;}
                    if($row[0] == ''){continue;}
                    // print_r($row);echo "<br>";echo "<br>";
                    // print_r($row);echo "<br>";echo "<br>";
                    // print_r($row);echo "<br>";
                    $insert_data[] = array(
                        'c_account_number' => $row[0],
                        'carea' => $row[1],
                        'meter_id' => $row[2],
                        'status' => $row[3],
                        'cname'  => $row[4],
                        'cphone'  => $row[5],
                        'caddress'  => $row[6],
                    );
                }
            }
            // die;
            if(!empty($insert_data)){
                $res = DB::table('customer')->insert($insert_data);
                // echo $res;
            }
            if($res){
                return redirect(url('/showcustomer'))->with('success', 'Excel Data Imported successfully.');
            }else{
                return redirect()->back()->with('error', 'Excel Data are not Imported.');
            }
        }
    }
}
