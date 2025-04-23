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
        Schema::create('accurate_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token', 200)->nullable()->index()->unique();
            $table->string('refresh_token', 200)->nullable()->index()->unique();
            $table->integer('expired_at')->nullable();
            $table->string('scopes', 250)->nullable();
            $table->string('user_request', 50)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accurate_tokens');
    }
};
