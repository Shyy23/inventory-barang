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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name', 255);
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('item_name', 255);
            $table->string('slug_item', 255)->unique();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('location_id');
            $table->integer('stock');
            $table->longText('description');
            $table->string('image', 255);
            $table->enum('status', ['available', 'out_of_stock']);
            $table->timestamps();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade')->index('idx_category_item');
            $table->foreign('location_id')->references('location_id')->on('locations')->onDelete('cascade')->onUpdate('cascade')->index('idx_location_item');
        });

        Schema::create('item_units', function (Blueprint $table) {
            $table->increments('unit_id');
            $table->unsignedInteger('item_id');
            $table->string('unit_name', 100);
            $table->enum('unit_status', ['available', 'borrowed', 'damaged', 'delayed']);
            $table->string('unit_image', 255);
            $table->timestamps();
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade')->index('idx_item_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_units');
        Schema::dropIfExists('items');
        Schema::dropIfExists('categories');
    }
};
