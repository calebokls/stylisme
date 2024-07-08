<?php

use App\Models\Marques;
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
        Schema::table('modelies', function (Blueprint $table) {
            $table->foreignIdFor(Marques::class)->constrained()->cascadeOnDelete()->after('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelies', function (Blueprint $table) {
            //
        });
    }
};
