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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('bill_no');
            $table->string('chalan_no');
            $table->string('serial_no');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('product_id')->constrained('products');
            $table->string('product_name');
            $table->integer('quantity');
            $table->text('details')->nullable();
            $table->decimal('total', 10, 2);
            $table->string('payment_type');
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
