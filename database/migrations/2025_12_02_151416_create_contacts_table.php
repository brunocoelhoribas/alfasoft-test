<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('contacts', static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->string('country_code');
            $table->string('number', 9);

            $table->unique(['country_code', 'numbercl']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('contacts');
    }
};
