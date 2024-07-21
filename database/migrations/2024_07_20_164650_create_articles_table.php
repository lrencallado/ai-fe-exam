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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('image', 2048)->nullable();
            $table->string('title')->nullable();
            $table->string('link', 2048)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 100)->default(\App\Enums\Status::FOR_EDIT);
            $table->foreignId('writer')->constrained('users');
            $table->foreignId('editor')->nullable()->constrained('users');
            $table->foreignId('company')->nullable()->constrained('companies');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
