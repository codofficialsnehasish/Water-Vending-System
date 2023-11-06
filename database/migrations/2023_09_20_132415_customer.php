<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("customer", function(Blueprint $table){
            $table->id("cid");
            $table->string("c_account_number");	
            $table->string("cname");
            $table->string("carea");
            $table->string("meter_id");
            $table->string("status");
            $table->string("cphone");
            $table->string("caddress");
            $table->string("bill_send_status")->nullable();
            $table->string("bill_send_date")->nullable();
            $table->string("messageid")->nullable();
            $table->string("payment_status")->nullable();
            $table->string("payment_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
