<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Excel;
use DB;

class Excelupload extends Controller
{
    function import(Request $request){
        $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();
        echo $path;
        die;
        // $data = Excel::load($path)->get();
        $data = Excel::toArray([],$path);
        print_r($data);
        // Excel::import(new UsersImport, 'users.xlsx', 's3', \Maatwebsite\Excel\Excel::XLSX);

        if(count($data) > 0){
            foreach($data as $value){
                foreach($value as $row){
                    // continue;
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
            if(!empty($insert_data)){
                DB::table('customer')->insert($insert_data);
            }
        }
        return redirect(url('/showcustomer'))->with('success', 'Excel Data Imported successfully.');
    }
}
