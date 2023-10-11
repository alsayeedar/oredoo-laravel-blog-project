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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("title");
            $table->string("slug");
            $table->foreignId("category_id");
            $table->longText("content");
            $table->string("thumbnail");
            $table->integer("views")->default(0);
            $table->boolean("is_featured")->default(false);
            $table->boolean("enable_comment")->default(true);
            $table->boolean("status")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
