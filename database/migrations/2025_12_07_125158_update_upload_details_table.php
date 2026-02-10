<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('upload_details', function (Blueprint $table) {
        
        if (!Schema::hasColumn('upload_details', 'resource_type')) {
            $table->string('resource_type')->nullable();
        }

        if (!Schema::hasColumn('upload_details', 'file')) {
            $table->string('file')->nullable();
        }

        if (!Schema::hasColumn('upload_details', 'url')) {
            $table->string('url')->nullable();
        }

        if (!Schema::hasColumn('upload_details', 'description')) {
            $table->text('description')->nullable();
        }

        if (!Schema::hasColumn('upload_details', 'uploaded_by')) {
            $table->unsignedBigInteger('uploaded_by')->nullable();
        }

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
