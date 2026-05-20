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
        Schema::table('machine_images', function (Blueprint $table) {

            $table->foreignId('machine_id')
                ->after('id')
                ->constrained('machines')
                ->onDelete('cascade');

            $table->string('image')
                ->after('machine_id');

            $table->integer('sort_order')
                ->default(0)
                ->after('image');

            $table->boolean('is_main')
                ->default(false)
                ->after('sort_order');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machine_images', function (Blueprint $table) {

            $table->dropForeign(['machine_id']);

            $table->dropColumn([
                'machine_id',
                'image',
                'sort_order',
                'is_main',
            ]);

        });
    }
};