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
        // ربط المصاريف بحجز (عرس) معين
        Schema::table('expenses', function (Blueprint $table) {
            $table->uuid('reservation_uuid')->nullable()->after('user_id');
        });

        // المصاريف المحفوظة لكل نوع حفلة (JSON) لاقتراحها في الحجز القادم
        Schema::table('party_types', function (Blueprint $table) {
            $table->text('default_expenses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('reservation_uuid');
        });

        Schema::table('party_types', function (Blueprint $table) {
            $table->dropColumn('default_expenses');
        });
    }
};
