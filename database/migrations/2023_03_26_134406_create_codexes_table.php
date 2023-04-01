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
        Schema::create('codexes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('type_uuid')
                ->references('uuid')->on('types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('judul')->unique();
            $table->string('slug');
            $table->longText('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codexes');
    }
};
