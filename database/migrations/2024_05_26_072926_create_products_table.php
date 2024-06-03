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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price');
            $table->integer('quantity')->nullable(); // Assuming quantity should be an integer
            $table->foreignId('category_id')->constrained()->nullable();
            // $table->foreignId('brand_id')->constrained()->nullable();
            // $table->foreignId('user_id')->constrained()->nullable();
            $table->integer('status')->default(1);
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->nullable(); // Changed to boolean type
            $table->boolean('is_popular')->nullable(); // Changed to boolean type
            $table->boolean('is_trending')->nullable(); // Changed to boolean type
            $table->boolean('is_latest')->nullable(); // Changed to boolean type
            $table->boolean('is_discounted')->nullable(); // Changed to boolean type
            $table->timestamps(); // Added created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
