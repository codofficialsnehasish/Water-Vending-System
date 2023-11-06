<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\MassageAPI;
use App\Http\Controllers\Excelupload;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[Admin::class,"login"])->name("login");
Route::get("/logout",[Admin::class,"logout"]);

Route::get("/dashboard",[Admin::class,"dashboard"])->middleware("auth");

Route::get("/register",[Admin::class,"register"])->middleware("admin");
Route::post("/adduser",[Admin::class,"adduser"]);
Route::get("/showuser",[Admin::class,"show_user"])->middleware("auth");
Route::post("/checkuser",[Admin::class,"checkuser"]);
Route::get("/del_user/{id}",[Admin::class,"del_user"])->middleware("admin");
Route::get("/edit_user/{id}",[Admin::class,"edit_user"])->middleware("admin");
Route::post("/updateuser",[Admin::class,"update_user"]);

Route::get("/customer",[Admin::class,"customer"])->middleware("auth");
Route::post("/addcustomer",[Admin::class,"addcustomer"]);
Route::get("/showcustomer",[Admin::class,"showcustomer"])->middleware("auth");
Route::get("/customerdel/{id}",[Admin::class,"customerdel"])->middleware("admin");
Route::get("/editcustomer/{id}",[Admin::class,"edit_customer"])->middleware("auth");
Route::post("/update_customer",[Admin::class,"update_customer"]);

Route::get("/meter",[Admin::class,"meter"])->middleware("admin");
Route::post("/addmeter",[Admin::class,"addmeter"]);
Route::get("/show_meter",[Admin::class,"show_meter"])->middleware("auth");
Route::get("/del_meter/{id}",[Admin::class,"del_meter"])->middleware("admin");
Route::get("/edit_meter/{id}",[Admin::class,"edit_meter"])->middleware("admin");
Route::post("/updatemeter",[Admin::class,"update_meter"]);

Route::get("/status",[Admin::class,"status"])->middleware("admin");
Route::post("/addstatus",[Admin::class,"addstatus"]);
Route::get("/show_status",[Admin::class,"show_status"])->middleware("auth");
Route::get("/del_status/{id}",[Admin::class,"del_status"])->middleware("admin");
Route::get("/edit_status/{id}",[Admin::class,"edit_status"])->middleware("admin");
Route::post("/updatestatus",[Admin::class,"update_status"]);

Route::get("/changepass",[Admin::class,"change_password"])->middleware("auth");
Route::post("/changep",[Admin::class,"change_pass"]);

Route::get("/area",[Admin::class,"area"])->middleware("admin");
Route::get("/showarea",[Admin::class,"show_area"])->middleware("auth");
Route::post("/addarea",[Admin::class,"add_area"]);
Route::get("/edit_area/{id}",[Admin::class,"edit_area"])->middleware("admin");
Route::get("/showarea",[Admin::class,"show_area"])->middleware("auth");
Route::post("/updatearea",[Admin::class,"update_area"]);
Route::get("/delarea/{id}",[Admin::class,"del_area"])->middleware("admin");

Route::get("/bill",[Admin::class,"bill"])->middleware("auth");
Route::post("/postbill",[Admin::class,"make_bill"]);
Route::get("/show_bill",[Admin::class,"show_bill"])->middleware("auth");
Route::get("/delete_bill/{id}",[Admin::class,"delete_bill"])->middleware("admin");
Route::get("/edit_bill/{id}",[Admin::class,"edit_bill"])->middleware("auth");
Route::post("/editbill",[Admin::class,"edited_bill"]);

Route::get("/add_expences",[Admin::class,"add_expences"]);
Route::get("/add_e_catagory",[Admin::class,"add_e_catagory"]);
Route::post("/addexpence",[Admin::class,"addexpence"]);
Route::get("/showexpence",[Admin::class,"showexpence"]);
Route::get("/showexp",[Admin::class,"showexp"]);
Route::post("/addexp",[Admin::class,"addexp"]);

Route::get("/reports",[Admin::class,"reports"]);
Route::post("/fromto",[Admin::class,"fromto"]);
Route::get("/generate_report",[Admin::class,"generate_report"]);
Route::get("/delexpence/{id}",[Admin::class,"delexpence"]);
Route::get("/editexpence/{id}",[Admin::class,"editexpence"]);
Route::post("/updateexp",[Admin::class,"updateexp"]);
Route::get("/delexpencecata/{id}",[Admin::class,"delexpencecata"]);
Route::get("/editexpencecata/{id}",[Admin::class,"editexpencecata"]);
Route::post("/updateexpcata",[Admin::class,"updateexpcata"]);
Route::get("/bill/{id}",[Admin::class,"billc"])->middleware("admin");

Route::get("/payment/{id?}",[Admin::class,"payment"])->middleware("admin");
Route::get("/payment",[Admin::class,"payment"])->middleware("admin");
Route::post("/make_payment",[Admin::class,"make_payment"]);
Route::get("/show_payments",[Admin::class,"show_payments"]);
Route::get("/recipt/{id}",[Admin::class,"recipt"]);

Route::get("/req/{id}",[Admin::class,"put_balance"]);


Route::get("/bireq/{id}",[Admin::class,"put_bilreq"]);
Route::get("/pbal/{id}",[Admin::class,"pbal"]);
Route::get("/gto",[Admin::class,"gto"]);



Route::get("/send_bill",[Admin::class,"send_bill"]);
Route::get("/billreq/{id}",[Admin::class,"billreq"]);


Route::get("/send_noti",[Admin::class,"send_notification"]);
Route::get("/baliszero/{id}",[Admin::class,"baliszero"]);


Route::get("/add_creditNote",[Admin::class,"credit_note"]);
Route::post("/post_creditNote",[Admin::class,"add_c_note"]);
Route::get("/show_credit_note",[Admin::class,"show_credit_note"]);
Route::get("/del_c_note/{id}",[Admin::class,"del_c_note"]);
Route::get("/credit_note_edit/{id}",[Admin::class,"credit_note_edit"]);
Route::post("/edit_c_note",[Admin::class,"edit_c_note"]);
Route::get("/cd_note/{id}",[Admin::class,"credit_note_ajax"]);


Route::get("/customer_history",[Admin::class,"customer_history"]);


Route::post("/fromcus",[Admin::class,"fromcus"]);





                       // MassageAPI

Route::post("/send",[MassageAPI::class,"bill_send"]);                  
Route::post("/notisend",[MassageAPI::class,"noti_send"]);                  
Route::get("/resend_masage/{id}",[MassageAPI::class,"resend_masage"]);                  
Route::get("/direct_send_masage/{id}",[MassageAPI::class,"direct_send_masage"]);   
Route::get("/notification_conn",[MassageAPI::class,"notification_conn"]);            




                        // Excel Route

Route::post("/import",[Excelupload::class,"import"]); 

