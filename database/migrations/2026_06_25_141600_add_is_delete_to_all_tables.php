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
        $tables = [
            'party_types',
            'reservations',
            'cat_dishes',
            'dishes',
            'reservation_dishes',
            'special_dates',
            'expenses',
            'notes',
            'notifications',
            'terms',
            'terms_content',
            'additional_services',
            'reservation_services',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table_blueprint) use ($table) {
                    if (!Schema::hasColumn($table, 'is_delete')) {
                        $table_blueprint->integer('is_delete')->default(0);
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'party_types',
            'reservations',
            'cat_dishes',
            'dishes',
            'reservation_dishes',
            'special_dates',
            'expenses',
            'notes',
            'notifications',
            'terms',
            'terms_content',
            'additional_services',
            'reservation_services',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table_blueprint) use ($table) {
                    if (Schema::hasColumn($table, 'is_delete')) {
                        $table_blueprint->dropColumn('is_delete');
                    }
                });
            }
        }
    }
};
