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
        Schema::create("creditnotes",function(Blueprint $table){
            $table->id("id");
            $table->string("receipt_number");
            $table->string("customer_id");
            $table->string("date")->nullable();
            $table->string("current_unit")->nullable();
            $table->string("previous_unit")->nullable();
            $table->string("difference")->nullable();
            $table->string("month_bill")->nullable();
            $table->string("pre_bill")->nullable();
            $table->string("total")->nullable();
            $table->string("paid")->nullable();
            $table->string("balance")->nullable();
            $table->string("receipt")->nullable();
            $table->string("mode")->nullable();
            $table->string("note")->nullable();
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
