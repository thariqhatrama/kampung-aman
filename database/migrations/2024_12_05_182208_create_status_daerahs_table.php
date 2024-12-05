<?php

use App\Models\KejadianStatusDaerah;
use App\Models\Kelurahan;
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
        Schema::create('status_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kelurahan::class)->constrained()->cascadeOnDelete();
            $table->integer('jumlah_laporan')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_daerahs');
    }
};
