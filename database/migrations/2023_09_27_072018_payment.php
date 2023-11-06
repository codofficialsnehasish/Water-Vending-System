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
        Schema::create("payment",function(Blueprint $t){
            $t->id("id");
            $t->string("customer_id");
            $t->string("date");
            $t->string("previous_balance");
            $t->string("paid_amount");
            $t->string("payment_mode");
            $t->timestamps();
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
