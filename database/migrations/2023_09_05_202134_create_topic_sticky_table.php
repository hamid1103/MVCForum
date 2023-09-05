<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('topic_sticky', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('post_id')->references('id')->on('post');
            $table->foreign('topics_id')->references('id')->on('topics');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_sticky');
    }
};
