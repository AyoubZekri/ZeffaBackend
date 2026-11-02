<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // القاعات الإضافية للحساب (قاعة الحساب نفسها ليست هنا)
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->integer('is_delete')->default(0);
            $table->timestamps();
        });

        // الحجز بدون قاعة يتبع قاعة الحساب
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('hall_uuid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('hall_uuid');
        });

        Schema::dropIfExists('halls');
    }
};
