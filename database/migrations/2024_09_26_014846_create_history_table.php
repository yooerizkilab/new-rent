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
        Schema::create('history', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_user'); // Foreign key for user
            $table->unsignedBigInteger('id_item'); // Foreign key for item
            $table->string('nama_user');
            $table->string('no_tlpn_user');
            $table->string('nama_item');
            $table->string('jenis_item'); // Typo correction: 'jeni_item' should be 'jenis_item'
            $table->string('lokasi');
            $table->string('proyek');
            $table->timestamps();

            // Optional: Define foreign key constraints if needed
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('id_item')->references('id')->on('item')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
