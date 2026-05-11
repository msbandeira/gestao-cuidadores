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
        Schema::table('service_plans', function (Blueprint $table) {
            $table->decimal('professional_repass_value', 10, 2)->nullable()->after('price');
            $table->decimal('company_intake_value', 10, 2)->nullable()->after('professional_repass_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_plans', function (Blueprint $table) {
            $table->dropColumn('professional_repass_value');
            $table->dropColumn('company_intake_value');
        });
    }
};
