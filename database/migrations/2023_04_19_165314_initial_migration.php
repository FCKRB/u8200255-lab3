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
        Schema::create(
            'guitar_shops',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('address');
                $table->integer('bodykit_capacity');
            }
        );

        Schema::create(
            'bodykit',
            function (Blueprint $table) {
                $table->id();
                $table->string('version');
                $table->string('name');
                $table->integer('manufacture_year');
                $table->foreignId('bodykit_shop_id')->constrained('bodykit_shops')->cascadeOnDelete();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodykits');
        Schema::dropIfExists('bodykit_shops');
    }
};
