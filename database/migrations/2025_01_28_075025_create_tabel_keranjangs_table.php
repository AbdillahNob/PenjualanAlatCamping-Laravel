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
        Schema::create('tabel_keranjangs', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idProduk');
            $table->string('noTelpon')->default(null);
            $table->integer('jumlahPesanan')->default(0);
            $table->decimal('totalPembayaran', 15, 2)->default(0);
            $table->enum('statusPembayaran', ['pending', 'success', 'failed'])->default('pending');
            $table->date('tanggalPesan')->default(null);
            $table->timestamps();
            
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idProduk')->references('id')->on('tabel_produks')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_keranjangs');
    }
};