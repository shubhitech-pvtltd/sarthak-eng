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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Add a title column
            $table->text('description'); // Add a description column
            $table->unsignedBigInteger('customer_id'); // Add a customer_id column (assuming it relates to clients/customers)
            // Add more columns as per your application's requirements
            $table->foreign('customer_id')->references('id')->on('clients'); // Assuming 'clients' is your clients/customers table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

