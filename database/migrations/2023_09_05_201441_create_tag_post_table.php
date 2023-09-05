<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tag_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('post_id')->references('id')->on('post');
            $table->foreign('tag_id')->references('id')->on('tag');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tag_article');
    }
};
