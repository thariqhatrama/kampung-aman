<?php

use App\Models\User;
use App\Models\JenisKejadian;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kejadians', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam');
            // $table->string('nama_pelapor');
            // $table->string('no_tlp');
            $table->text('lokasi_kejadian');
            $table->foreignIdFor(JenisKejadian::class)->constrained()->cascadeOnDelete();
            $table->text('catatan_laporan');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kejadians');
    }
};
