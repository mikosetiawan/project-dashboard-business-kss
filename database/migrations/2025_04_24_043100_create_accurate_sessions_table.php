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
        Schema::create('accurate_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('user_request', 50)->nullable()->index();
            $table->string('access_token', 200)->nullable()->index();
            $table->string('session_id', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accurate_sessions');
    }
};
