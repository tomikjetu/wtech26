<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('billing_first_name')->nullable()->after('billing_same');
            $table->string('billing_last_name')->nullable()->after('billing_first_name');
            $table->text('billing_address')->nullable()->after('billing_last_name');
            $table->string('billing_city')->nullable()->after('billing_address');
            $table->string('billing_zip')->nullable()->after('billing_city');
            $table->string('billing_country')->nullable()->after('billing_zip');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'billing_first_name',
                'billing_last_name',
                'billing_address',
                'billing_city',
                'billing_zip',
                'billing_country',
            ]);
        });
    }
};
