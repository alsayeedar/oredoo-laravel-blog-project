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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText("message");
            $table->foreignId("post_id");
            $table->integer("parent_id")->nullable()->default(null);
            $table->integer("user_id")->nullable()->default(null);
            $table->string("name")->nullable()->default(null);
            $table->string("email")->nullable()->default(null);
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
        Schema::dropIfExists('comments');
    }
};
