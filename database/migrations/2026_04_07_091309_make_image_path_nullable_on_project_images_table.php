<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
            $table->string('video_path')->nullable()->change();
            $table->string('media_type')->default('image')->change();
        });
    }

    public function down(): void
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('image_path')->nullable(false)->change();
            $table->string('video_path')->nullable()->change();
            $table->string('media_type')->default('image')->change();
        });
    }
};