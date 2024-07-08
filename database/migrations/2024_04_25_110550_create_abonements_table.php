<?php

use App\Models\User;
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
        Schema::create('abonements', function (Blueprint $table) {
            $table->id();
            $table->dateTime('debut');
            $table->dateTime('fin');
            $table->foreignIdFor(User::class)->constrained();
            $table->boolean('premium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonements');
    }
};
