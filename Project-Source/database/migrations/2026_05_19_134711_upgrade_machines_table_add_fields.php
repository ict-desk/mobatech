<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->string('title')->after('id');

            $table->string('category')->nullable()->after('title');
            $table->string('brand')->nullable()->after('category');
            $table->string('condition')->nullable()->after('brand');
            $table->string('year')->nullable()->after('condition');
            $table->string('material')->nullable()->after('year');

            $table
                ->string('stock_status')
                ->default('op_voorraad')
                ->after('material');

            $table
                ->text('short_description')
                ->nullable()
                ->after('stock_status');

            $table
                ->longText('description')
                ->nullable()
                ->after('short_description');

            $table
                ->longText('extra_info')
                ->nullable()
                ->after('description');

            $table
                ->boolean('is_active')
                ->default(true)
                ->after('extra_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'category',
                'brand',
                'condition',
                'year',
                'material',
                'stock_status',
                'short_description',
                'description',
                'extra_info',
                'is_active',
            ]);
        });
    }
};
