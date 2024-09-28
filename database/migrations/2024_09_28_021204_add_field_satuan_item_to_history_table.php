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
        Schema::table('history', function (Blueprint $table) {
            $table->string('satuan_item')->nullable()->after('nama_item');
            $table->bigInteger('jumlah')->default(1)->after('proyek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history', function (Blueprint $table) {
            $table->dropColumn('satuan_item');
            $table->dropColumn('jumlah');
        });
    }
};
