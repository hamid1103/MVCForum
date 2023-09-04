<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->id();
            $table->foreign('post_id')->references('id')->on('post');
            $table->integer('score');
            $table->longText('context');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reply');
    }
};
