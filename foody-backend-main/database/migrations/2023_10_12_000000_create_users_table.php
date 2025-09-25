<?php

use App\Statuses\ActiveStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('deviceKey')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('user_type');
            $table->boolean('active')->default(ActiveStatus::ACTIVE);
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
