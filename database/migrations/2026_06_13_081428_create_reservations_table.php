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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('username')->nullable();
            $table->string('phone_numper')->nullable();

            $table->date('booking_date')->nullable();

            $table->integer('booking_period')->nullable();

            $table->uuid('type_of_party_uuid')->nullable();

            $table->decimal('price', 12, 2)->nullable();

            $table->text('notes')->nullable();

            $table->decimal('deposit', 12, 2)->nullable();

            $table->decimal('remaining_amount', 12, 2)->nullable();

            $table->integer('number_of_men')->nullable();

            $table->integer('number_of_women')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
