<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('resources', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }


    public function up()
{
    Schema::create('resources', function (Blueprint $table) {
        $table->id();
        $table->enum('resource_type', ['video', 'book', 'handwritten', 'assignment', 'external', 'project', 'lab']);
        $table->string('url')->nullable();
        $table->string('file_path')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
