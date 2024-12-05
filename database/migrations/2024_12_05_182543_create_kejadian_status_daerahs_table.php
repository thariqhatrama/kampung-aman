<?php

use App\Models\JenisKejadian;
use App\Models\StatusDaerah;
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
        Schema::create('kejadian_status_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StatusDaerah::class)->nullable()->cascadeOnDelete();
            $table->foreignIdFor(JenisKejadian::class)->nullable()->cascadeOnDelete();
            $table->integer('jumlah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_status_daerahs');
    }
};
