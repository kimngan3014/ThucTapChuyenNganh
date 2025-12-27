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
        Schema::create('products', function (Blueprint $table): void {
        $table->id();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');  
        $table->string('name'); // Tên danh mục
        $table->string('image')->nullable();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        $table->decimal('price', 10, 2)->default(0);
        $table->text('description')->nullable();
        $table->boolean('status')->default(1); // Trạng thái
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
