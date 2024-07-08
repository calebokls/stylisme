<?php

use App\Models\Modely;
use Illuminate\Database\Eloquent\Model;
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
        Schema::table('signalisations', function (Blueprint $table) {
            $table->foreignIdFor(Modely::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signalisations', function (Blueprint $table) {
            $table->foreignIdFor(Model::class);
        });
    }
};
