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
    // If table doesn't exist, create it with proper schema
    if (!Schema::hasTable('notes')) {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // ✅ FOREIGN KEY (VERY IMPORTANT)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('title');
            $table->string('cover_image')->nullable();
            $table->longText('content');
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
