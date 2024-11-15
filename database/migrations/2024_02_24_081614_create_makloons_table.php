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
        Schema::create('makloons', function (Blueprint $table) {
            $table->id();
            $table->string('makloon_number')->unique();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('makloon_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('makloon_id');
            $table->string('name');
            $table->string('code');
            $table->integer('qty');
            $table->bigInteger('price');
            $table->string('size');
            $table->string('unit');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('makloon_id')->references('id')->on('makloons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makloons');
        Schema::dropIfExists('makloon_details');
    }
};
