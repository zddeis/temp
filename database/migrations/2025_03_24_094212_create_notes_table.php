<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->text('body');
            $table->foreignIdFor(\App\Models\User::class, "user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_pinned')->default(false);
            $table->string("condition")->default("day/116");
            $table->timestamps();

            $table->index('is_pinned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};