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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 200);
            $table->integer('category_id');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('barcode', 100);
            $table->string('name', 100);
            $table->string('description', 2000);
            //packed
            $table->float('packed_weight',8,2)->default(0);;
            $table->float('packed_height',8,2)->default(0);;
            $table->float('packed_width',8,2)->default(0);;
            $table->float('packed_depth',8,2)->default(0);;
            $table->boolean('refrigerated')->default(false);

            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
