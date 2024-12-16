<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->float('amount');
            $table->string('method');
            $table->date('date');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('payments');
    }
    
};
