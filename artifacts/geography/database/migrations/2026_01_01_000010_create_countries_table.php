<?php

declare(strict_types=1);

use Heritage\Database\Migrations\Migration;
use Heritage\Database\Schema\Blueprint;
use Heritage\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso_alpha_2', 2)->unique();
            $table->string('iso_alpha_3', 3)->unique();
            $table->string('dial_code', 10)->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('flag_emoji', 8)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
