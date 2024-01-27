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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('total',10,2);
            $table->double('shipping',10,2);
            $table->double('gst',10,2);
            $table->double('subtotal',10,2);
            $table->string('coupan_code')->nullable();
            $table->double('coupan_discount',10,2)->nullable();
            $table->string('payment_method');
            $table->string('order_status');
            $table->string('payment_status');  

            //user address details
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode');
            $table->string('landmark')->nullable();
            $table->string('note')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
