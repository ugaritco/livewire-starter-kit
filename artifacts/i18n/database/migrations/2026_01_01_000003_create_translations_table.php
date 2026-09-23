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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('translatable_type');
            $table->unsignedBigInteger('translatable_id');
            $table->string('locale', 12)->index();
            $table->string('key')->index();
            $table->text('value');
            $table->timestamps();

            $table->index(['translatable_type', 'translatable_id']);
            $table->unique(['translatable_type', 'translatable_id', 'locale', 'key'], 'translatable_locale_key_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
