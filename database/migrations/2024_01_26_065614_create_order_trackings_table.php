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
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('tracking_id');
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->date('date');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('tracking_id')->references('id')->on('trackings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_trackings');
    }
};
