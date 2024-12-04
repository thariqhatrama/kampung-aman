<?php

use App\Models\JenisEdukasi;
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
        Schema::create('edukasi_hukums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JenisEdukasi::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi_hukums');
    }
};
