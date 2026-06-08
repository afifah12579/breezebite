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
        // This is your ONLY auto-increment column (The Primary Key)
        $table->id(); 
        
        // Change 'table_number' to a normal, un-incremented unsigned integer
        $table->unsignedBigInteger('table_number'); 
        
        // Your remaining columns from your blueprint query execution
        $table->string('order_type');
        $table->decimal('total_price', 8, 2);
        $table->string('status')->default('Pending');
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
