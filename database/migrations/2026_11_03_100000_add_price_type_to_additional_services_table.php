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
        // طريقة حساب السعر: 0 = سعر ثابت، 1 = لكل شخص (السعر × عدد المعزومين)
        Schema::table('additional_services', function (Blueprint $table) {
            $table->integer('price_type')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('additional_services', function (Blueprint $table) {
            $table->dropColumn('price_type');
        });
    }
};
