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
        Schema::create('general_options', function (Blueprint $table) {

            $table->id();

            $table->string('option_name');
            $table->string('title');

            $table->string('value')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('lbl_text')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->boolean('is_excluded')
                ->default(false);

            $table->boolean('is_default')
                ->default(false);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_options');
    }
};