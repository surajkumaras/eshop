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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->boolean('like');
            $table->tinyInteger('rate');
            $table->unsignedBigInteger('p_id');
            $table->foreign('p_id')->references('id')->on('products')->onDelete('cascade')->comment('ProductId');
            $table->unsignedBigInteger('u_id');
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade')->comment('UserId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
