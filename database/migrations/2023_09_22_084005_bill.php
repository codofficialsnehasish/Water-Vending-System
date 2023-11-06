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
        Schema::create("billing",function(Blueprint $table){
            $table->id("id");
            $table->string("receipt_number");
            $table->string("customer_id");
            $table->varchar("date");
            $table->string("current_unit");
            $table->string("previous_unit");
            $table->string("difference");
            $table->string("month_bill")->nullable();
            $table->string("pre_bill");
            $table->string("total")->nullable();
            $table->string("paid")->nullable();
            $table->string("balance")->nullable();
            $table->string("receipt")->nullable();
            $table->string("mode")->nullable();
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
