<?php

use App\Statuses\OrderStatus;
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
            $table->foreignId('table_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('waiter_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('chef_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();
            $table->double('total_price');
            $table->time('time_Waiter')->nullable();
            $table->time('estimated_time');
            $table->boolean('status')->default(OrderStatus::PENDING);
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
